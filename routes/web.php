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


Auth::routes();
//アイテム→ 一覧
Route::get('/', 'ItemController@index');
//アイテム→詳細
Route::get('/item/detail/{id}', 'ItemController@detail')->name('item.detail');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function () { return redirect('/admin/home'); });
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});

//adminログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('/home', 'Admin\HomeController@index');
	//Route::get('/login', 'Admin\HomeController@index');
});
Route::group(['prefix' => 'item', 'middleware' => 'auth:admin'], function() {
//商品編集画面
Route::get('/edit/{id}', 'ItemController@edit')->name('item.edit');
//商品編集確認画面
Route::patch('/edit/{id}', 'ItemController@editConfirm')->name('item.confirm');
//商品編集登録
Route::post('/edit/{id}', 'ItemController@editRegist')->name('item.regist');
//商品新規追加
Route::get('/add', 'ItemController@add')->name('item.add');
//商品新規追加確認
Route::post('/add/', 'ItemController@addConfirm')->name('item.add_confirm');
});
