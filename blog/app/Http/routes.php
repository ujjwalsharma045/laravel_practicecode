<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::auth();
Route::get('/', ['middleware' => 'auth','uses'=>'UserController@index']);
Route::get('user/', ['middleware' => 'auth','uses'=>'UserController@index']);
Route::post('/', ['middleware' => 'auth','uses'=>'UserController@index']);
Route::post('user/', ['middleware' => 'auth','uses'=>'UserController@index']);
Route::get('user/add', ['middleware' => 'auth','uses'=>'UserController@add']);
Route::post('user/add', ['middleware' => 'auth','uses'=>'UserController@add']);
Route::get('user/edit/{id}', ['as'=>'user.update', 'uses'=>'UserController@edit']);
Route::patch('user/edit/{id}', ['as'=>'user.update', 'uses'=>'UserController@edit']);
Route::get('user/index', ['as'=>'user.index' , 'middleware' => 'auth','uses'=>'UserController@index']);
Route::post('user/index', ['as'=>'user.index', 'middleware' => 'auth','uses'=>'UserController@index']);
Route::get('user/view/{id}', ['middleware' => 'auth','uses'=>'UserController@view']);
Route::get('user/remove/{id}', ['middleware' => 'auth','uses'=>'UserController@remove']);

Route::get('page/', ['middleware' => 'auth','uses'=>'PageController@index']);
Route::post('page/', ['middleware' => 'auth','uses'=>'PageController@index']);
Route::get('page/add', ['middleware' => 'auth','uses'=>'PageController@add']);
Route::post('page/add', ['middleware' => 'auth','uses'=>'PageController@add']);
Route::get('page/edit/{id}', ['as'=>'page.update', 'uses'=>'PageController@edit']);
Route::patch('page/edit/{id}', ['as'=>'page.update', 'uses'=>'PageController@edit']);
Route::get('page/index', ['middleware' => 'auth','uses'=>'PageController@index']);
Route::post('page/index', ['middleware' => 'auth','uses'=>'PageController@index']);
Route::get('page/view/{id}', ['middleware' => 'auth','uses'=>'PageController@view']);
Route::get('page/remove/{id}', ['middleware' => 'auth','uses'=>'PageController@remove']);  

//Route::get('admin/', ['middleware' => 'auth','uses'=>'AdminController@index']);
Route::get('admin/login', ['uses'=>'AdminController@login']);
Route::get('admin/logout', ['middleware' =>'admin', 'uses'=>'AdminController@logout']);

Route::post('admin/login', ['uses'=>'AdminController@login']);
Route::get('admin/user/index', ['as'=>'admin.user.index', 'middleware' =>'admin','uses'=>'UserController@admin_index']);
Route::post('admin/user/index', ['as'=>'admin.user.index', 'middleware' => 'admin','uses'=>'UserController@admin_index']);

Route::get('admin/user/add', ['middleware' => 'admin','uses'=>'UserController@admin_add']);
Route::post('admin/user/add', ['middleware' => 'auth','uses'=>'UserController@admin_add']);

Route::get('admin/user/edit/{id}', ['middleware' => 'auth','uses'=>'UserController@admin_edit']);
Route::patch('user/edit/{id}', ['as'=>'admin.user.update', 'uses'=>'UserController@admin_edit']);

Route::get('admin/user/view/{id}', ['middleware' => 'auth','uses'=>'UserController@admin_view']);
Route::post('admin/user/view/{id}', ['middleware' => 'auth','uses'=>'UserController@admin_view']);

Route::get('admin/user/remove/{id}', ['middleware' => 'auth','uses'=>'UserController@admin_remove']);
Route::post('admin/user/remove/{id}', ['middleware' => 'auth','uses'=>'UserController@admin_remove']);

//Route::post('/', 'UserController@index');



Route::get('/home', 'HomeController@index');
