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

//首页
Route::get('/', function () {
    return view('welcome');
});

//登录
//php artisan make:auth自动生成的
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//使用资源控制器

//用户
Route::get('user/index','UserController@index');
Route::any('user/update/{id}','UserController@update');

//书架
Route::get('book','BookController@index');
Route::post('book/store','BookController@store');
Route::get('book/create','BookController@create');
Route::any('book/del/{id}','BookController@destroy');
Route::any('book/show/{id}','BookController@show');
Route::get('book/edit/{id}','BookController@edit');
Route::any('book/update/{id}','BookController@update');
Route::any('book/restore/{id}','BookController@restore');

//文摘
Route::get('article','ArticleController@index');
Route::any('article/store','ArticleController@store');
Route::any('article/update/{id}','ArticleController@update');
Route::get('article/show/{id}','ArticleController@show');
Route::any('article/del/{id}','ArticleController@destroy');
Route::get('article/edit/{id}','ArticleController@edit');
Route::get('article/create/{id}','ArticleController@create');

//标签
Route::get('tag/create','TagController@create');
Route::post('tag/store','TagController@store');
Route::get('tag/edit/{id}','TagController@edit');
Route::any('tag/update/{id}','TagController@update');

//后台
Route::get('admin/article','AdminController@article');
Route::get('admin/book','AdminController@book');
Route::get('admin','AdminController@index');
Route::get('admin/tag','AdminController@tag');


