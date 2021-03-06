<?php

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

Route::redirect('/', '/bbs');

// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('bbs', 'PostsController@index');
//Route::get('bbs', '\App\Http\Controllers\PostsController@index');

Route::resource('bbs', 'PostsController', ['only' => [
    'index', 'show', 'create', 'store', 'edit', 'update', 'destroy'
    ]])
    // ->middleware('auth')
;

Route::resource('comment', 'CommentsController', ['only' => ['store']]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
