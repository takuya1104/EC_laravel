<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EditEmailAddress;
use App\Http\Requests\EditUserInfo;
use App\User;
use App\EditUser;
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
		$new_password = $request->new_password;
		//NULLではない場合ハッシュ化
		if (!$new_password == NULL) {
			$new_password = Hash::make($new_password);
		}
		$using_password = Hash::make($request->using_password);

		//新規のパスワード内容と既存のパスワードの変更がない場合リダイレクト
		if (Hash::check($request->new_password, Auth::user()->password)) {
			session()->flash('flash_message', 'パスワードの変更がありません');
			return redirect(url()->previous());
		}

		//名前の変更がない場合
		if ($request->user_name == Auth::user()->name) {
			session()->flash('flash_message', '現在使用中の名前からの変更がありません');
			return redirect(url()->previous());
		}

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
			session()->flash('flash_message', '登録情報を変更しました');
		}
		return redirect('home');
	}

	/*
	 * メール受け取り情報更新
	 */

	public function receive_email(Request $request, $token) {
		$edit_user_token = EditUser::where('token', $token);
		//トークンがDBに存在していなければリダイレクト
		if ($edit_user_token->exists()) {
			//メール送信から30分経過してるか確認
			if (!$edit_user_token->value('updated_at')->addMinutes(30) < Carbon::now()) {
				//変更内容
				$input_user_data = $edit_user_token->first();
				//メールアドレスが一意になるように制御
				if (User::where('email', $input_user_data->email_address)->exists()) {
					session()->flash('flash_message', 'そのメールアドレスは使用できません');
					return redirect(route('home'));
				}
				//ユーザー情報取得
				$user_info = User::find($input_user_data->user_id);

				//名前の変更がない場合
				if (!$input_user_data->name == NULL) {
					$user_info->name = $input_user_data->name;
				}

				//パスの変更がない場合
				if (!$input_user_data->new_password == NULL) {
					$user_info->password = $input_user_data->new_password;
				}
				$user_info->email = $input_user_data->email_address;
				$user_info->save();
				session()->flash('flash_message', '登録情報を変更しました');
			} else {
				session()->flash('flash_message', '30分経過しているので無効なURLです');
			}
		} else {
			session()->flash('flash_message', '不正なアクセスです');
		}
		return redirect(route('home'));
	}
}
