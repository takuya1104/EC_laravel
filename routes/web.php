<?php

/*
|--------------------------------------------------------------------------

|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */


Auth::routes();
//商品一覧
Route::get('/', 'ItemController@index');
//商品詳細
Route::get('/item/detail/{id}', 'ItemController@detail')->name('item.detail');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function() {
	Route::get('/', function () { return redirect('/admin/home'); });
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});
//ユーザログイン後
Route::group(['prefix' => '/', 'middleware' => 'auth'], function() {
	//カート一覧画面
	Route::get('cart/{id}', 'CartController@index')->name('cart.index');
	//ログアウト処理
	Route::get('logout', 'CartController@logout')->name('logout');
	//カート追加
	Route::get('add_item/{id}', 'CartController@addItem')->name('cart.add_item');
	//削除処理
	Route::delete('cart', 'CartController@delete')->name('cart.delete');
});

//adminログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::get('/home', function () { return redirect('/admin/item'); });
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
});

//adminログイン後リダレクト後
Route::group(['prefix' => 'admin/item', 'middleware' => 'auth:admin'], function() {
	//商品一覧
	Route::get('/', 'AdminItemController@index');
	//商品詳細画面
	Route::get('detail/{id}', 'AdminItemController@detail')->name('admin_item.detail');
	//商品編集画面
	Route::get('edit/{id}', 'AdminItemController@edit')->name('admin_item.edit');
	//商品編集確認画面
	Route::patch('edit_confirm/{id}', 'AdminItemController@editConfirm')->name('admin_item.confirm');
	//商品編集登録
	Route::post('edit/{id}', 'AdminItemController@editRegist')->name('admin_item.regist');
	//商品新規追加
	Route::get('add', 'AdminItemController@add')->name('admin_item.add');
	//商品新規追加確認
	Route::post('add', 'AdminItemController@addConfirm')->name('admin_item.add_confirm');
	//ログアウト処理
	Route::get('logout', 'AdminItemController@logout')->name('admin_item.logout');
});
