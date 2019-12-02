<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Mail\EditEmailAddress;
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
		//パスワードは変更しない場合ははNULL可能その場合はメールアドレスの変更が条件分岐になって、名前とメールアップデート
		//パスワードは変更する場合はの場合はメールアドレスの変更が条件分岐になって、名前とメールアップデートとパスワード

		$request->validate([
			'new_password' => 'min:8|string|nullable',
			'confirm_password' => 'min:8|string|nullable|same:new_password',
			'using_password' => 'required|string|',
		]);

		//ハッシュ化されたパスと入力されたパスが同じか照合
		if(!(Hash::check($request->using_password, Auth::user()->password))) {
			session()->flash('flash_message', '入力したパスワードと現在のパスワードが間違っています');
			return redirect(url()->previous());
		}

		//ユーザー情報の変更がない場合、変更した文言のみ出力
		$password = Hash::make($request->new_password);
		//ログインユーザーのアドレスと入力されたアドレスが同じか照合
		if (Auth::user()->email !== $request->user_email) {
			$mail_to = "takuya2.msbal.";
			$url = url('/editemailaddress');
			Mail::to($mail_to)->send(new EditEmailAddress($url));
			session()->flash('flash_message', '確認用メールを送信しました');
			return redirect(url()->previous());
		} else {
			//ログインユーザーのアドレスと入力されたアドレスが同じ場合
			if ($request->new_password === NULL && $request->confirm_password === NULL) {
			}
			session()->flash('flash_message', 'パスワードを変更しました');
			return redirect(url()->previous());
		}

		return view('edit_user_account.receive_input');
	}
}
