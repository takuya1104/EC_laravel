<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use Auth;
use App\User;

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
		$user = User::where('twitter_id', $twitterUser->id)->first();
		if (!$user) {
			$user = User::create([
				'twitter_id' => $twitterUser->id,
				'name' => $twitterUser->name,
				'token' => $twitterUser->token,
				'token_secret' => $twitterUser->tokenSecret,
			]);
		}
		Auth::login($user);
		return redirect('/');
	}

	// ログアウト
	public function logout(Request $request)
	{
		Auth::logout();
		return redirect('/');
	}
}

