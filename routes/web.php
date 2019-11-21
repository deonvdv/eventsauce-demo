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

use App\User;
use Todos\TodoId;
use Todos\Commands\AddTodo;
use Illuminate\Contracts\Bus\Dispatcher;
use Symfony\Component\HttpFoundation\Request;
use Todos\Commands\UpdateTodo;

Route::get('/', function (Request $request) {
    //return view('welcome');
    $user = User::first();

    app(Dispatcher::class)->dispatchNow(new AddTodo(
        $id = TodoId::create(),
        $user->id,
        $request->todo,
    ));

    return "New todo created: " . $id->toString();
});

Route::get('/update/{id}', function (Request $request, string $id) {
    app(Dispatcher::class)->dispatchNow(new UpdateTodo(
        new TodoId($id),
        $request->todo,
    ));

    return "Todo updated: " . $id;
});
