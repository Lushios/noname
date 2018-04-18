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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('posts', 'PostsController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//comments trihard

Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::delete('comments/{post_id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);

//home
Route::post('home', ['uses' => 'UsersController@store', 'as' => 'users.store']);
Route::resource('users', 'UsersController');