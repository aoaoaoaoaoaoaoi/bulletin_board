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

Route::get('/join_group', 'JoinGroupController@index');
Route::post('/join_group_complete', 'JoinGroupController@joinGroup');
Route::post('/show_group_info', 'JoinGroupController@showGroupInfo');

Route::get('/make_thread_index', 'MakeThreadController@index');
Route::post('/make_thread', 'MakeThreadController@makeThread');

Route::get('/thread', 'ThreadController@index');
Route::post('/send_message', 'ThreadController@sendMessage');

Route::get('/edit_profile', 'EditProfileController@index');
Route::post('/edit_profile_complete', 'EditProfileController@saveProfile');
Route::post('/make_tag', 'EditProfileController@makeTag');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/search_thread', 'HomeController@searchThread');
