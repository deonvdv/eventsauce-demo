<?php

namespace App\Providers;

use Jaeger\Config;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\EventSource\Contextable;
use Illuminate\Support\Facades\DB;
use App\EventSource\TracingJobPipe;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Jaeger\Propagator\JaegerPropagator;
use Illuminate\Log\Events\MessageLogged;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Foundation\Http\Events\RequestHandled;
use OpenTracing\Formats;

use const OpenTracing\Formats\TEXT_MAP;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Setup a unique ID for each request. This will allow us to find
        // the request trace in the jaeger ui later
        $this->app->instance('context.uuid', Uuid::uuid1());
        // Get the base config object
        $config = Config::getInstance();

        // dd($config);
        // If in development or testing, you can use this to change
        // the tracer to a mocked one (NoopTracer)
        //
        // if (!app()->environment('production')) {
        //     $config->setDisabled(true);
        // }
        // Start the tracer with a service name and the jaeger address
        $tracer = $config->initTracer(config('app.name'), '0.0.0.0:6831');
        $tracer->extract(TEXT_MAP, $_SERVER);

        // Set the tracer as a singleton in the IOC container
        $this->app->instance('context.tracer', $tracer);
        // Start the global span, it'll wrap the request/console lifecycle
        $globalSpan = $tracer->startSpan('app');


        // Set the uuid as a tag for this trace
        // $globalSpan->setTags(['uuid' => app('context.uuid')->toString()]);
        $globalSpan->setTag('uuid', app('context.uuid')->toString());
        // If running in console (a.k.a a job or a command) set the
        // type tag accordingly
        $type = 'http';
        if (app()->runningInConsole()) {
            $type = 'console';
        }
        $globalSpan->setTag('type', $type);
        // Save the global span as a singleton too
        $this->app->instance('context.tracer.globalSpan', $globalSpan);

        // Set activespan to global span initially
        $this->app->instance('context.tracer.activeSpan', $globalSpan);
        // When the app terminates we must finish the global span
        // and send the trace to the jaeger agent.
        app()->terminating(function () {
            app('context.tracer.globalSpan')->finish();
            app('context.tracer')->flush();
        });

        // Listen for each logged message and attach it to the global span
        Event::listen(MessageLogged::class, function (MessageLogged $e) {
            app('context.tracer.activeSpan')->log((array) $e);
        });

        // Listen for the request handled event and set more tags for the trace
        Event::listen(RequestHandled::class, function (RequestHandled $e) {
            $tags = [
                'user_id' => auth()->user()->id ?? "-",
                'company_id' => auth()->user()->company_id ?? "-",
                'request_host' => $e->request->getHost(),
                'request_path' => $path = $e->request->path(),
                'request_method' => $e->request->method(),
                'api' => Str::contains($path, 'api'),
                'response_status' => $e->response->getStatusCode(),
                'error' => !$e->response->isSuccessful(),
            ];

            foreach ($tags as $tag => $value) {
                app('context.tracer.globalSpan')->setTag($tag, $value);
            }
        });

        // Also listen for queries and log then,
        // it also receives the log in the MessageLogged event above
        DB::listen(function ($query) {
            app('context.tracer.activeSpan')->log([
                'query' => str_replace('"', "'", $query->sql),
                'bindings' => str_replace('"', "'", $query->bindings),
                'time' => $query->time . 'ms',
            ]);

            Log::debug("[DB Query] {$query->connection->getName()}", [
                'query' => str_replace('"', "'", $query->sql),
                'time' => $query->time . 'ms',
            ]);
        });


        // // Each time we call the controller, this is a new number
        // $this->app->instance('context', [
        //     "trace_id" => Str::random(32),
        // ]);

        // Add context to all Jobs
        Queue::createPayloadUsing(function ($connection, $queue, $payload) {

            // Get existing context payload
            $context = Arr::get($payload, 'context', []);

            // // Get active tracing span
            // $spanContext = app('context.tracer.activeSpan')->getContext();
            // $tracing = ['tracing' => [
            //     'parent_id' => $spanContext->parentIdToString(),
            //     'span_id' => $spanContext->spanIdToString(),
            // ]];

            // // Merge tracing context into context
            // $context = array_merge($context, $tracing);

            // Inject Jeager trace header
            (new JaegerPropagator)->inject(app('context.tracer.activeSpan')->getContext(), '', $context);

            return ['context' => $context];
        });

        // Extract context from Jobs
        Queue::before(function (JobProcessing $event) {
            // $event->connectionName
            // $event->job
            // $event->job->payload()

            dump($event->job->payload());
            dump($context = Arr::get($event->job->payload(), 'context'));

            // // Get the tracer
            // $tracer = app('context.tracer');
            // dump($tracer);

            // // Extract the ids from the job context
            // $tracer->extract(TEXT_MAP, $context);
            // dump($tracer);

            // // Start the span
            // $globalSpan = $tracer->startSpan('job');

            // // Set the uuid as a tag for this trace
            // $globalSpan->setTag('uuid', app('context.uuid')->toString());

            // // Set the type tag
            // $globalSpan->setTag('type', 'console');

            // // Save the global span as a singleton too
            // $this->app->instance('context.tracer.globalSpan', $globalSpan);

            // // Set activespan to global span initially
            // $this->app->instance('context.tracer.activeSpan', $globalSpan);

            // // assume its different
            // // $context["trace_id"] = Str::random(32);

            // // Set current context
            // // $this->app->instance('context', $context);

            // TODO:: have to set tracing context based on extracted
        });

        // // pipe it
        app(\Illuminate\Bus\Dispatcher::class)->pipeThrough([
            TracingJobPipe::class,
        ]);
    }
}
