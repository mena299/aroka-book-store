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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('table');
});


Route::get('cms/register', 'cms\UserController@register');
Route::post('cms/register', 'cms\UserController@createNewUser');

Route::get('cms/login', 'cms\UserController@login');
Route::post('cms/login', 'cms\UserController@auth');
Route::get('cms/logout', 'cms\UserController@logout');

