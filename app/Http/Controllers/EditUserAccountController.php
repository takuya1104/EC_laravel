<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateAddress;
use App\Providers\Validator;
use App\User;
use App\Item;
use App\Admin;
use App\Cart;
use App\Address;
use App\Prefecture;
use GuzzleHttp\Client;
use Hash;

class EditUserAccountController extends Controller
{
	/*
	 * 入力画面
	 */
	public function index(Request $request, $id) {
		return view('edit_user_account.index');
	}

	/*
	 * 入力内容受け取り画面
	 */

	public function receive_input(Request $request) {

		if (!Auth::check()) {
			return redirect(url()->previous());
		}

		//新規パスワードが8文字以上の文字列であり、確認用新規パスワードが新規パスワードと同じである事を確認
		//現在登録済みユーザーが８文字以下の可能性があるのでusing_passwordには文字数のバリデーションはかけない
		$request->validate([
			'new_password' => 'required|min:8|string',
			'confirm_password' => 'required|min:8|string',
			'using_password' => 'required|string',
		]);

		//ハッシュ化されたパスと入力されたパスが同じか照合
		if(!(Hash::check($request->using_password, Auth::user()->password))) {
			session()->flash('flash_message', '現在のパスワードが間違っています');
			return redirect(url()->previous());
		}

		//ログインユーザーのアドレスと入力されたアドレスが同じか称号
		if (Auth::user()->email !== $request->user_email) {
		} else {
		}

		return view('edit_user_account.receive_input');
	}
}
