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
Route::any('/wechat', 'WeChatController@serve');
Route::any('/a', 'WeChatController@down');
Route::any('/c', 'WeChatController@c');
Route::any('/cx', 'CxController@c');
Route::any('/cxbz', 'CxController@cxbenzhou');
Route::any('/cxby', 'CxController@cxbenyue');
Route::get('/quire', 'WeChatController@quire');
Route::any('/mendian', 'MendianController@index');
