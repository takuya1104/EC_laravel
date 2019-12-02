<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Mail\EditEmailAddress;
use App\Http\Requests\CreateAddress;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use App\Providers\Validator;
use App\User;
use App\Item;
use App\Admin;
use App\Cart;
use App\Address;
use App\Prefecture;
use GuzzleHttp\Client;
use Hash;
use Carbon\Carbon;

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
		//パスワードのみNULL可能

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
		$user_name = $request->user_name;
		$email_address = $request->user_email;
		$new_password = $request->new_password;
		$confirm_password = $request->confirm_password;
		$using_password = $request->using_password;
		$limit_time = Carbon::now()->addMinutes(30);
		//ログインユーザーのアドレスと入力されたアドレスが同じか照合
		if (Auth::user()->email !== $email_address) {
			$user_input = array('id' => Auth::id(), 'name' => $user_name, 'email_address' => $email_address, 'reset_password' => $new_password, 'using_password' => $using_password, 'limit_time ' => $limit_time);
			$encrypted_info = Crypt::encrypt($user_input);
			$url = route('edit_user_account.receive_email', ['encrypted_info' => $encrypted_info]);
			Mail::to($email_address)->send(new EditEmailAddress($url));
			session()->flash('flash_message', '確認用メールを送信しました');
			return redirect(url()->previous());
		} else {
			//ログインユーザーのアドレスと入力されたアドレスが同じ場合
			if ($new_password === NULL && $confirm_password === NULL) {
			}
			session()->flash('flash_message', 'パスワードを変更しました');
			return redirect(url()->previous());
		}

		return view('edit_user_account.receive_input');
	}
	public function receive_email(Request $request, $encrypted_info) {
		$user = new User();
		$decrypted_info = Crypt::decrypt($encrypted_info);
		$user_id = $decrypted_info['id'];
		$user_name = $decrypted_info['name'];
		$email_address = $decrypted_info['email_address'];
		$using_password = $decrypted_info['using_password'];
		$reset_password = $decrypted_info['reset_password'];
		if ($using_password == NULL) {
		}
	}
}
