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

Route::get('/', function () {
    return view('welcome');
});


//Game Fourm
Route::get('/fourm', 'GamesController@index')->name('games_index');
Route::get('/fourm/create', 'GamesController@create')->name('games_create');
Route::post('/fourm', 'GamesController@store')->name('games_store');
Route::get('/fourm/{slug}/edit', 'GamesController@edit')->name('game_edit');
Route::put('/fourm/{slug}', 'GamesController@update')->name('games_update');
Route::delete('/fourm/{slug}', 'GamesController@destroy')->name('game_delete');

//Game Category
Route::get('/fourm/{slug}', 'CategoryController@index')->name('category_list');
Route::get('/fourm/{slug}/create', 'CategoryController@create')->name('create_category');
Route::post('/fourm/{slug}', 'CategoryController@store') -> name('category_store');
Route::get('/fourm/{game_slug}/{category_slug}/edit', 'CategoryController@edit') ->name('category_edit');
Route::put('/fourm/{game_slug}/{category_slug}/', 'CategoryController@update') ->name('category_update');
Route::get('/fourm/post/show_all/{category}', 'CategoryController@showAll')->name('category_show_all');


//Post

Route::get('/fourm/{game_slug}/{category_slug}', 'PostController@index') -> name('post_list');
Route::get('/fourm/{game_slug}/{category_slug}/create', 'PostController@create')->name('post_create');
Route::post('/fourm/{game_slug}/{category_slug}', 'PostController@store')->name('post_store');
Route::get('/fourm/{game_slug}/{category_slug}/{post_slug}/edit', 'PostController@edit')->name('post_edit');
Route::put('/fourm/{game_slug}/{category_slug}/{post_slug}', 'PostController@update')->name('post_update');
Route::get('/fourm/{game_slug}/{category_slug}/{post_slug}', 'PostController@show')->name('post_detail');
Route::delete('/fourm/post/{slug}', 'PostController@destroy')->name('post_delete');

//Comment

Route::post('/post/{post}', 'CommentController@store')->name('post_comment');
Route::get('/post/{post}/{comment}/edit', 'CommentController@edit')->name('comment_edit');
Route::put('/post/{post}/{post_id}', 'CommentController@update')->name('comment_update');
Route::delete('/fourm/post/comment/{comment_id}', 'CommentController@destroy')->name('comment_delete');



//Auth
Route::post('/change_password/{user}', 'Auth\ChangePasswordController@changePassword')->name('change_password');
//Route::post('/change_password/{user}', 'CommentController@changePassword')->name('change_password');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

