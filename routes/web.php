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

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return view('test.test_blade');
});

Route::get('post/{id}', 'PostController@findOne');
Route::get('post', 'PostController@filterPost');
Route::post('post', 'PostController@insertPost');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', function () {
        return view('test.test_blade');
    });
});
