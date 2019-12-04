<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;

class TwitterController extends Controller
{

	// ログイン
	public function login(){
		return Socialite::driver('twitter')->redirect();
	}

	// コールバック
	public function callback(){
		try {
			$twitterUser = Socialite::driver('twitter')->user();
		} catch (\Exception $e) {
			return redirect('auth/twitter');
		}
		// 各自ログイン処理
		// $user = User::where('auth_id', $twitterUser->id)->first();
		// if (!$user) {
		//     $user = User::create([
		//         'auth_id' => $twitterUser->id
		//   ]);
		// }
		//Auth::login($user);
		return redirect('/');
	}

	// ログアウト
	public function logout(Request $request)
	{
		// 各自ログアウト処理
		// 例
		// Auth::logout();
		return redirect('/');
	}
}

