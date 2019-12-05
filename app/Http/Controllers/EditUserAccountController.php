<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use App\Mail\EditEmailAddress;
use App\Http\Requests\EditUserInfo;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\URL;
use App\Providers\Validator;
use App\User;
use App\Item;
use App\Admin;
use App\Cart;
use App\Address;
use App\Prefecture;
use App\EditUser;
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

	public function receive_input(EditUserInfo $request) {

		if (!Auth::check()) {
			return redirect(url()->previous());
		}

		//ハッシュ化されたパスと入力されたパスが同じか照合
		if(!(Hash::check($request->using_password, Auth::user()->password))) {
			session()->flash('flash_message', '入力したパスワードと現在のパスワードが間違っています');
			return redirect(url()->previous());
		}

		//ユーザー情報の変更がない場合、変更した文言のみ出力
		$token = substr(base_convert(bin2hex(openssl_random_pseudo_bytes(100)),16,36),0,100);
		$user_name = $request->user_name;
		$email_address = $request->user_email;
		$new_password = Hash::make($request->new_password);
		$using_password = Hash::make($request->using_password);
		//ログインユーザーのアドレスと入力されたアドレスが同じか照合
		if (Auth::user()->email !== $email_address) {
			//メールアドレスの重複を確認
			if (User::where('email', $email_address)->exists()) {
				session()->flash('flash_message', '存在しているメールアドレスです');
				return redirect(url()->previous());
			}
			$url = route('edit_user_account.receive_email', ['token' => $token]);
			//新規のユーザーIDであれば挿入, それ以外は更新
			EditUser::updateOrCreate([
				'user_id' => Auth::id(),
				], [
					'name' => $user_name,
					'using_password' => $using_password,
					'new_password' => $new_password,
					'email_address' => $email_address,
					'token' => $token,
				]);
			//メール送信
			Mail::to($email_address)->send(new EditEmailAddress($url));
			session()->flash('flash_message', '確認用メールを送信しました');
			return redirect(url()->previous());
		} else {
			//名前新規パスの入力がない場合
			if ($request->new_password == NULL && $user_name == NULL) {
				session()->flash('flash_message', '変更内容がありません');
				return redirect(url()->previous());
			}
			$user_info = User::find(Auth::id());
			//名前が空欄ではない場合
			if (!$user_name == NULL) {
				$user_info->name = $user_name;
			}
			//新規パスワードが空欄ではない場合
			if (!$request->new_password == NULL) {
				$user_info->password = $new_password;
			}
			$user_info->save();
			session()->flash('flash_message', 'パスワードを変更しました');
			return redirect(url()->previous());
		}

		return view('edit_user_account.receive_input');
	}
	public function receive_email(Request $request, $token) {
		$edit_user_hash = EditUser::where('token', $token);
		//トークンがDBに存在していなければリダイレクト
		if ($edit_user_hash->exists()) {
			//メール送信から30分経った場合無効
			if (!$edit_user_hash->value('updated_at')->addMinutes(30) < Carbon::now()) {
				$input_user_data = $edit_user_hash->get();
				foreach ($input_user_data as $data) {
					$data->user_id;
					$data->name;
					$data->new_password;
					$data->using_password;
					$data->email_address;
				}
				//メールアドレスが一意になるように制御
				if (User::where('email', $data->email_address)->exists()) {
					return redirect(route('home'));
				}
				$user_info = User::find($data->user_id);
				$user_update_data = User::where('id', $data->user_id)->get();
				foreach ($user_update_data as $user_update) {
					$user_update->name;
					$user_update->password;
					$user_update->email;
				}
				if (!$data->name == NULL) {
					$user_info->name = $data->name;
				}
				if (!$data->new_password == NULL) {
					$user_info->password = $data->new_password;
				}
				if (!$data->email_address == NULL) {
					$user_info->email = $data->email_address;
				}
				$user_info->save();
				return redirect(route('home'));
			} else {
				//	return redirect(route('home'));
			}
		} else {
			return redirect(route('home'));
		}
		$user = new User();
	}
}
