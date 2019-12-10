<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAddress;
use App\Providers\Validator;
use App\User;
use App\Address;
use App\Prefecture;


class AddressController extends Controller
{

	/*
	 * 住所を登録画面
	 */
	public function index(Request $request, $id) {
		//GETのidがログイン中のユーザーid以外ならリダイレクト
		if ($id != Auth::id()) {
			return redirect(url()->previous());
		}
		//セレクトボックスへ都道府県を渡す
		$prefectures = Prefecture::select('id', 'pref_name')->get();

		return view('address.index', compact('prefectures'));
	}

	/*
	 * 住所・電話番号を追加・編集
	 */
	public function add(CreateAddress $request) {

		if (!Auth::check()) {
			return redirect(url()->previous());
		}

		$address_class = new Address;
		//POSTデータ取得
		$customer_name = $request->customer_name;
		$postal_code1 = $request->postal_code1;
		$postal_code2 = $request->postal_code2;
		$prefecture = $request->pref;
		$address = $request->address;
		$phone_number = $request->phone;
		$address = $address_class->del_blank($address);
		//編集画面から取得新規作成の場合はNULL
		$hidden_id = $request->hidden_id;

		//都道府県名とidを同時に取得して、分離、空白削除
		$prefecture_explode = explode('.', $prefecture);
		$pref_check = array();
		foreach ($prefecture_explode as $pref_info) {
			$pref_info  = preg_replace("/( |　)/", "", $pref_info );
			array_push($pref_check, $pref_info);
		}
		//都道府県idから都道府県名取得
		$pref_name_check = Prefecture::where('id', $pref_check[0])->value('pref_name');
		if(!$pref_name_check === NULL || $pref_check[1] !== $pref_name_check) {
			session()->flash('flash_message', '都道府県を選択して下さい');
			return redirect(url()->previous());
		}

		//DB登録用エレメント作成
		$user_id = Auth::id();
		$postal_code = $postal_code1 . '-' . $postal_code2;
		$prefecture_id = $pref_check[0];
		$city = $address;
		$phone_number = $phone_number;

		//hiddenでidが設定されていて、かつ住所登録が存在していない場合
		if ($hidden_id !== NULL && $address_class->where('id', $hidden_id)->where('user_id', $user_id)->doesntExist()) {
			session()->flash('flash_message', '選択されてた住所は存在していません');
			return redirect(url()->previous());
		}

		//idとユーザーIDが存在していればUPDATEなければ新規でINSERT
		$address_save = Address::updateOrCreate([
			'id' => $hidden_id,
			'user_id' => $user_id
		], [
			'customer_name' => $customer_name,
			'postal_code' => $postal_code,
			'prefecture_id' => $prefecture_id,
			'city' => $city,
			'phone_number' => $phone_number
		]);
		//データ送信後リダイレクト
		return redirect()->route('address.confirm', ['id' => $user_id]);
	}

	/*
	 * 住所・電話番号一覧
	 */
	public function confirm(Request $request, $id) {
		//GETのidがログイン中のユーザーid以外ならリダイレクト
		if ($id != Auth::id()) {
			return redirect(url()->previous());
		}
		//ユーザーの登録ずみ住所取得
		$registered_address = Address::with('prefecture')->where('user_id', $id)->get();

		return view('address.confirm', compact('registered_address'));
	}

	/*
	 * 住所・電話番号を削除
	 */
	public function del_address(Request $request) {

		if (!Auth::check()) {
			return redirect(url()->previous());
		}

		$address_class = new Address;
		$user_id = Auth::id();
		$id = $request->del_hidden_id;
		//ユーザーidとAddressテーブルのidが一致していて存在しているかどうか確認
		if($address_class->where('id', $id)->where('user_id', $user_id)->exists()) {
			$address_class->where('id', $id)->delete();
			session()->flash('flash_message', '削除しました');
		} else {
			session()->flash('flash_message', '存在していない住所が選択されました');
		}

		return redirect(url()->previous());
	}

	/*
	 * 住所・電話番号の編集画面
	 */
	public function edit_address(Request $request, $id) {

		if (!Auth::check()) {
			return redirect(url()->previous());
		}

		$address_class = new Address();
		//GETで受けた登録情報IDが削除ずみかもしくは存在していない場合
		if ($address_class->where('id', $id)->where('user_id', Auth::id())->doesntExist()) {
			session()->flash('flash_message', '選択されてた住所は削除されているか存在していません');
			return redirect(url()->previous());
		}

		//編集したいユーザーの登録時情報を取得
		$registered_address = Address::where('id', $id)->where('user_id', Auth::id())->first();
		$customer_name = $registered_address->customer_name;
		$prefecture_id = $registered_address->prefecture_id;
		$city = $registered_address->city;
		$postal_code = explode("-", $registered_address->postal_code);
		$phone_number = $registered_address->phone_number;
		$prefectures = Prefecture::select('id', 'pref_name')->get();

		return view('address.edit_address', compact('customer_name', 'prefecture_id', 'city', 'postal_code', 'phone_number', 'id', 'prefectures'));
	}

}
