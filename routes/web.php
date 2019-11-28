<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\EventSource\TraceHelper;
use App\User;
use Todos\TodoId;
use OpenTracing\Tracer;
use Todos\Commands\AddTodo;
use OpenTracing\GlobalTracer;
use Todos\Commands\UpdateTodo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Bus\Dispatcher;
use Symfony\Component\HttpFoundation\Request;

Route::get('/', function (Request $request) {

    // Get Tracer
    $tracer = app('context.tracer');

    // Start child span from GlobalSpan
    // $span = $tracer->startSpan('db.user.get', ['child_of' => app('context.tracer.globalSpan')]);

    // // Set ActiveSpan
    // // need to wrap this into a method that can accept a callable
    // app()->instance('context.tracer.activeSpan', $span);
    // $user = User::first();
    // Auth::login($user);
    // $span->finish();

    $user = TraceHelper::trace(
        'db.user.get',
        function () {
            return User::first();
        },
        null,
        []
    );

    $loggedIn = TraceHelper::trace(
        'auth.user.login',
        function () use ($user) {
            Auth::login($user);
        },
        null,
        []
    );

    // $parent = GlobalTracer::get()->startActiveSpan('parent');
    // $child = GlobalTracer::get()->startActiveSpan('my_second_span');
    // file_get_contents('http://php.net');
    // $child->close();
    // $parent->close();

    // dump(app('context.tracer.globalSpan'));
    // dump(app('context.uuid'));

    app(Dispatcher::class)->dispatch(new AddTodo(
        $id = TodoId::create(),
        $user->id,
        $request->todo,
    ));

    return "New todo created: " . $id->toString();
});

Route::get('/update/{id}', function (Request $request, string $id) {

    dump(app('context.tracer.globalSpan'));
    // dump(app('context.uuid'));

    app(Dispatcher::class)->dispatchNow(new UpdateTodo(
        new TodoId($id),
        $request->todo,
    ));

    return "Todo updated: " . $id;
});

// Route::get('/', function () {
//     Log::info('Serving welcome page', ['name' => 'welcome']);
//     Log::info('A simple laravel log statement', ['url' => request()->getUri()]);
//     return view('welcome');
// });

Route::get('/error', function () {
    throw new Exception("Something went wrong! That's ok, I'm in the trace now :)");
});

Route::get('/really-long-request', function () {
    Log::info("Processing...");
    sleep(2);
    Log::info("Loong 2s response time :/");
});
