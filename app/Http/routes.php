<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'mainController@home');
Route::get('/article/category/{category}', 'mainController@category');
Route::get('/article/read/{id}', 'mainController@read');
Route::post('/article/comment', 'mainController@comment');