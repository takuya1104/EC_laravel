<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Item;

class ItemController extends Controller
{

	public function index() {
		$items = Item::simplePaginate(9);
		return view('item/index', compact('items'));
	}

	public function detail($id) {
		$check_id = Item::is_exist_id($id);
		if ($check_id) {
			$item = Item::find($id);
			session()->put('detail_id', $id);
			return view('item/detail', compact('item'));
		} else {
			return redirect(url()->previous());
		}
	}

	public function logout(Request $request) {
		Auth::logout();
		return redirect()->to('/');
	}
}
