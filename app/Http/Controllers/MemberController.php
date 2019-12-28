<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class MemberController extends Controller
{

	/*
	 * ユーザー一覧画面
	 */
	public function index(Request $request) {
		//未ログイン管理者ユーザーはリダイレクト
		if (!Auth::check()) {
			return redirect(url()->previous());
		}
		//会員登録しているユーザーidとname取得
		$users = User::select('id', 'name')->get();
		return view('member.index', compact('users'));
	}

	/*
	 * ユーザー詳細画面
	 */
	public function detail(Request $request, $id) {
		//未ログイン管理者ユーザーはリダイレクト
		if (!Auth::check()) {
			return redirect(url()->previous());
		}
		//GETされたidを持つユーザーが存在しない場合リダイレクト
		if (!User::where('id', $id)->exists()) {
			return redirect(url()->previous());
		}
		//受けたidの登録ユーザーを取得
		$user_data = User::find($id);
		return view('member.detail', compact('user_data'));
	}
}

