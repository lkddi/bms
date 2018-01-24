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


Auth::routes();
Route::redirect('/', '/home', 301);
Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $router->get('post', 'PostController@index')->name('admin.login');
    $router->get('mendian', 'MendianController@index')->name('admin.login');
    $router->get('quyu', 'QuyuController@index')->name('admin.login');
    $router->get('qudao', 'QudaoController@index')->name('admin.login');
    $router->get('model', 'ModelController@index')->name('admin.login');
    $router->get('sale', 'SaleController@index')->name('admin.login');
    $router->get('zhengce', 'ZhengceController@index')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout');

    $router->get('dash', 'DashboardController@index');
});