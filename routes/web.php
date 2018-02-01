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
Route::any('/cxall', 'CxController@cxall');
Route::get('/quire', 'WeChatController@quire');
Route::any('/mendian', 'MendianController@index');


Auth::routes();
Route::redirect('/', '/home', 301);
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('mendian', 'MendianController');
Route::resource('mode', 'ModeController');
Route::resource('qudao', 'QudaoController');
Route::resource('zhengce', 'ZhengceController');
Route::resource('sale', 'SaleController');


//Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
//{
//    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
//    $router->post('login', 'LoginController@login');
//    $router->any('logout', 'LoginController@logout');
//
//    $router->get('dash', 'DashboardController@index');
//    $router->get('post', 'PostController@index');
//    $router->resource('mendian', 'MendianController');
//    $router->resource('quyu', 'QuyuController');
//    $router->resource('qudao', 'QudaoController');
//    $router->resource('model', 'ModelController');
//    $router->resource('zhengce', 'ZhengceController');
//    $router->resource('sale', 'SaleController');
//});