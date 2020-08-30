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

Route::get('/group', 'GroupController@index');
Route::get('/make_group', 'MakeGroupController@index');
Route::post('/make_group_complete', 'MakeGroupController@makeGroup');

Route::get('/search_group_index', 'JoinGroupController@index');
Route::post('/reverse_group_participation', 'JoinGroupController@reverseParticipation');
Route::post('/show_group_info', 'JoinGroupController@showGroupInfo');
Route::post('/search_group', 'JoinGroupController@searchGroup');

Route::get('/make_thread_index', 'MakeThreadController@index');
Route::post('/make_thread', 'MakeThreadController@makeThread');

Route::get('/thread', 'ThreadController@index');
Route::post('/send_message', 'ThreadController@sendMessage');
Route::post('/reverse_reaction', 'ThreadController@reverseReaction');

Route::get('/edit_profile', 'EditProfileController@index');
Route::post('/edit_profile_complete', 'EditProfileController@saveProfile');
Route::post('/make_tag', 'EditProfileController@makeTag');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/search_thread', 'HomeController@searchThread');

Route::get('/user', 'UserController@index');
Route::post('/search_user', 'GroupController@searchUser');
