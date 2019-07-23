<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Item;
use App\Admin;
use App\Cart;
use Validator;

class CartController extends Controller
{
	public function index(Request $request, $id) {
		//GETのidがユーザー以外ならリダイレクト
		if ($id != Auth::id()) {
			return redirect(url()->previous());
		}

		$count = Cart::where('customer_id', $id)->count();

		if ($count != 0) {
			$items_in_carts = Item::
				join('carts', 'items.id','=', 'carts.item_id')
				->where('carts.customer_id', $id)
				->whereNull('carts.deleted_at')
				->get();
		}
		return view('cart.index', compact('count', 'items_in_carts'));
	}

	public function addItem(Request $request, $id) {
		if (Auth::check()) {
			$customer_id = Auth::id();

			$add_cart = new Cart();
			$add_cart->item_id = $id;
			$add_cart->customer_id = $customer_id;
			$add_cart->save();

			session()->flash('flash_message', 'カートに追加しました');
			return redirect()->route('cart.index', ['id' => $customer_id]);
		} else {
			session()->flash('flash_message', 'ログインしてください');
			return redirect(url()->previous());
		}
	}

	public function delete(Request $request) {
		$customer_id = Auth::id();
		Cart::where('id', $request->cart_id)->where('customer_id', $customer_id)->delete();
		session()->flash('flash_message', '削除しました');
		return redirect()->route('cart.index', ['id' => $customer_id]);
	}

	public function logout() {
		Auth::logout();
		return redirect()->to('/login');
	}
}
