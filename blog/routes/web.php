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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/threads', 'ThreadController')->except(['show']);
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::post('/threads/{channel}/{thread}/replies', 'ReplyController@store')->name('addReply');
Route::get('/threads/{channel}/{thread}/replies', 'ReplyController@index');
Route::get('threads/{channel}', 'ThreadController@index');
Route::post('replies/{reply}/favorites', 'FavoriteController@store')->name('favorite');
Route::get('profiles/{user}', 'ProfileController@show')->name('profile');
Route::delete('threads/{channel}/{thread}', 'ThreadController@destroy')->name('thread.delete');
Route::delete('replies/{reply}', 'ReplyController@destroy')->name('reply.destroy');
Route::patch('replies/{reply}', 'ReplyController@update')->name('reply.update');
Route::delete('replies/{reply}/favorites', 'FavoriteController@destroy')->name('favorite.destroy');
Route::post('/threads/{channel}/{thread}/subscribtions', 'ThreadSubscribtionController@store')->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subscribtions', 'ThreadSubscribtionController@destroy')->middleware('auth');
Route::get('profiles/{user}/notifications', 'NotificationController@index');
Route::delete('profiles/{user}/notifications/{notification}', 'NotificationController@destroy');







