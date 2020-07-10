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


//Game forum
Route::get('/forum', 'GamesController@index')->name('games_index');
Route::get('/forum/create', 'GamesController@create')->name('games_create');
Route::post('/forum', 'GamesController@store')->name('games_store');
Route::get('/forum/{slug}/edit', 'GamesController@edit')->name('game_edit');
Route::put('/forum/{slug}', 'GamesController@update')->name('games_update');
Route::delete('/forum/{slug}', 'GamesController@destroy')->name('game_delete');

//Game Category
Route::get('/forum/{slug}', 'CategoryController@index')->name('category_list');
Route::get('/forum/{slug}/create', 'CategoryController@create')->name('create_category');
Route::post('/forum/{slug}', 'CategoryController@store') -> name('category_store');
Route::get('/forum/{game_slug}/{category_slug}/edit', 'CategoryController@edit') ->name('category_edit');
Route::put('/forum/{game_slug}/{category_slug}/', 'CategoryController@update') ->name('category_update');
Route::get('/forum/post/show_all/{category}', 'CategoryController@showAll')->name('category_show_all');


//Post
Route::get('/forum/{game_slug}/{category_slug}', 'PostController@index') -> name('post_list');
Route::get('/forum/{game_slug}/{category_slug}/create', 'PostController@create')->name('post_create');
Route::post('/forum/{game_slug}/{category_slug}', 'PostController@store')->name('post_store');
Route::get('/forum/{game_slug}/{category_slug}/{post_slug}/edit', 'PostController@edit')->name('post_edit');
Route::put('/forum/{game_slug}/{category_slug}/{post_slug}', 'PostController@update')->name('post_update');
Route::get('/forum/{game_slug}/{category_slug}/{post_slug}', 'PostController@show')->name('post_detail');
Route::delete('/forum/post/{slug}', 'PostController@destroy')->name('post_delete');

//Comment

Route::post('/post/{post}', 'CommentController@store')->name('post_comment');
Route::get('/post/{post}/{comment}/edit', 'CommentController@edit')->name('comment_edit');
Route::put('/post/{post}/{post_id}', 'CommentController@update')->name('comment_update');
Route::delete('/forum/post/comment/{comment_id}', 'CommentController@destroy')->name('comment_delete');



//Auth
Route::post('/change_password/{user}', 'Auth\ChangePasswordController@changePassword')->name('change_password');
//Route::post('/change_password/{user}', 'CommentController@changePassword')->name('change_password');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

