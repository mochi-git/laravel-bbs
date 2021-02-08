<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::redirect('/', '/bbs');

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any','.*');


//Route::get('bbs', 'PostsController@index');
//Route::get('bbs', '\App\Http\Controllers\PostsController@index');

/*
Route::resource('/bbs', 'PostsController', ['only' => [
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
]])
    // ->middleware('auth')
;

Route::resource('comment', 'CommentsController', ['only' => ['store']]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/posts', function () {
    // return ['Ken','Mike','John','Lisa'];
    return App\Models\Post::latest()->get();
});
*/

Route::get('/user', function (Request $request) {

    $users = App\Models\User::all();

    return response()->json(['users' => $users]);
});

Route::get('/user/{user}', function (App\Models\User $user) {

    return response()->json(['user' => $user]);
});

Route::patch('/user/{user}', function (App\Models\User $user, Request $request) {

    $user->update($request->user);

    return response()->json(['user' => $user]);
});

Route::delete('/user/{user}', function (App\Models\User $user) {

    $user->delete();

    return response()->json(['message' => 'delete successfully']);
});

Route::post('/user', function(Request $request){

	$user = App\Models\User::create($request->user);

	return response()->json(['user' => $user]);

});
