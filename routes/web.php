<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// 首页
Route::get('/', function () {
	return view('welcome');
});

Route::get('/request/url', 'RequestController@getUrl');

/* 管理员后台 BENGIN */
// 登录页面
Route::get('/admin/login', function () {
	return view('admin/login');
})->name('admin.login');
// 登录请求
Route::post('/admin/login', 'Admin\LoginController@index');
// 首页请求
Route::group(['middleware' => 'adminGuest'], function () {
	Route::get('/admin/', 'Admin\IndexController@index');
	Route::get('/admin/index', 'Admin\IndexController@index');
});
Route::any('/admin/login/logout', 'Admin\LoginController@logout');
/* 管理员后台 END */
