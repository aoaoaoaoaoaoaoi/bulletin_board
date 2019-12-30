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

Route::get('/test', function () {
    return view('test');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/make_group', 'MakeGroupController@index');
Route::post('/make_group_complete', 'MakeGroupController@makeGroup');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
