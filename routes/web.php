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
Route::get('/', 'ItemController@index')->name('item.index');
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
	//削除処理
	Route::delete('cart', 'CartController@delete')->name('cart.delete');
});

//ユーザー情報編集
Route::group(['prefix' => '/edit_user_account', 'middleware' => 'auth'], function() {
	//ユーザー情報更新画面作成
	Route::get('{id}', 'EditUserAccountController@index')->name('edit_user_account');
	//ユーザー情報挿入
	Route::post('receive_input', 'EditUserAccountController@receive_input')->name('edit_user_account.receive_input');
	//メール受け取り
	Route::get('receive_email/{token}', 'EditUserAccountController@receive_email')->name('edit_user_account.receive_email');
});

//住所追加編集削除
Route::group(['prefix' => '/address', 'middleware' => 'auth'], function() {
	Route::get('/{id}', 'AddressController@index')->name('address.index');
	//住所確認画面
	Route::get('confirm/{id}', 'AddressController@confirm')->name('address.confirm');
	//住所削除画面
	Route::delete('del_address/', 'AddressController@del_address')->name('address.del_address');
	//住所編集画面
	Route::get('edit_address/{id}', 'AddressController@edit_address')->name('address.edit_address');
});

//住所追加編集削除
Route::group(['prefix' => '/address', 'middleware' => ['web']], function () {
	//住所追加編集
	Route::post('add/', 'AddressController@add')->name('address.add');
});

//カート追加
Route::post('add_item', 'CartController@addItem')->name('cart.add_item');

//決済処理
Route::group(['prefix' => '/settlement', 'middleware' => 'auth'], function() {
	//決済情報取得
	Route::get('/', 'SettlementController@index')->name('settlement.index');
	//決済ペイメント
	Route::post('/', 'SettlementController@payment')->name('settlement.payment');
	//決済キャンセル
	Route::post('cancel', 'SettlementController@cancel')->name('settlement.cancel');
	//決済キャンセル
	Route::get('confirm/{id}', 'SettlementController@confirm')->name('settlement.confirm');
});

//adminログイン後
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
	Route::get('/home', function () { return redirect('/admin/item'); });
	Route::post('logout', 'Admin\LoginController@logout')->name('admin.logout');
	Route::get('/member/', 'MemberController@index')->name('member.index');
	Route::get('/member/detail/{id}', 'MemberController@detail')->name('member.detail');
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


// ログインURL
Route::get('auth/twitter', 'Auth\TwitterController@login')->name('twitter.login');
// コールバックURL
Route::get('auth/twitter/callback', 'Auth\TwitterController@callback');
// ログアウトURL
Route::get('auth/twitter/logout', 'Auth\TwitterController@logout')->name('twitter.logout');
