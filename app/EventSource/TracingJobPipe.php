<?php

namespace App\EventSource;

use OpenTracing\Reference;
use App\EventSource\TraceHelper;

class TracingJobPipe
{

    public function handle($job, \Closure $next)
    {
        // // Check if class has trait
        // if (in_array(
        //     Contextable::class,
        //     array_keys(class_uses($job))
        // )) {
        //     // dump('yes');
        //     $job->context = app('context');
        // }

        // // Get Tracer
        // $tracer = app('context.tracer');

        // $ref = Reference::create(Reference::CHILD_OF, app('context.tracer.globalSpan'));
        // dump(app('context.tracer.globalSpan')->getContext());
        // // Start Child Span
        // $span = $tracer->startSpan(
        //     'job.' . strtolower(str_replace('\\', '.', get_class($job))),
        //     ['references' => $ref]
        // );

        // // Execute Job
        // $results = $next($job);

        // // Finish Span
        // $span->finish();


        $results = TraceHelper::trace(
            'job.' . strtolower(str_replace('\\', '.', get_class($job))),
            function ($span) use ($job, $next) {
                // $span->setTag('payload', $job);
                return $next($job);
            },
            null,
            []
        );

        return $results;
    }
}
