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

Route::get('/', 'BlogController@index')->name('welcome');

Route::resource('posts','PostController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['verify' => true]);

Route::get('/admin','AdminController@index')->name('admin');

Route::get('/editor', 'EditorController@index')->name('editor');

Route::get('/addRole/{id}', 'AdminController@addRole')->name('addRole');
Route::get('/removeRole/{id}', 'AdminController@removeRole')->name('removeRole');
Route::post('/confirmRole/{id}', 'AdminController@confirmRole')->name('confirmRole');
Route::post('/destroyRole/{id}', 'AdminController@destroyRole')->name('destroyRole');