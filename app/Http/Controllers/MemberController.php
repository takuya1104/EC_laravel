<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;
use App\Purchase;
use App\Settlement;

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
		//$upurchase = Settlement::with('getItems')->where('user_id', $id)->get();
		$purchase_infos = Settlement::with('prefecture')->with('getItems')->where('user_id', $id)->get();
		//受けたidの登録ユーザーを取得
		$user_data = User::find($id);
		return view('member.detail', compact('user_data', 'purchase_infos'));
	}

	/*
	 * 商品ステータス変更
	 */
	public function status(Request $request) {
		//未ログイン管理者ユーザーはリダイレクト
		if (!Auth::check()) {
			return redirect(url()->previous());
		}
		DB::table('item_settlement')->where('id', $request->purchase_id)->update(['status_id' => $request->purchase_status]);
		session()->flash('flash_message', 'ステータスの変更をしました');
		return redirect(url()->previous());
	}
}

