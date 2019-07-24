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
		//GETのidがログイン中のユーザーid以外ならリダイレクト
		if ($id != Auth::id()) {
			return redirect(url()->previous());
		}

		$exist = Cart::where('customer_id', $id)->exists();
		//カートの中身があるか確認
		if ($exist) {
			$items_in_carts = Item::
				join('carts', 'items.id','=', 'carts.item_id')
				->where('carts.customer_id', $id)
				->whereNull('carts.deleted_at')
				->where('carts.item_amount', '>',  0)
				->orderBy('carts.id')
				->get();
		}
		return view('cart.index', compact('exist', 'items_in_carts'));
	}

	public function addItem(Request $request) {
		//ログイン確認
		if (Auth::check()) {
			$customer_id = Auth::id();
			$item_id = $request->hidden_item_id;
			$session_id = $request->session()->get('detail_id');

			//hiddenからの値とitemのidの照合
			if ($item_id != $session_id){
				$request->session()->forget('detail_id');
				return redirect(url()->previous());
			}
			//アイテムの存在確認
			$is_exist_id = Item::is_exist_id($item_id);
			if ($is_exist_id) {
				//レコードが存在していたら、INSERTあればitem_amountをUPDATEする処理をする
				$in_cart = Cart::firstOrCreate([
					'item_id' => $item_id,
					'customer_id' => $customer_id
				]);
				//存在していなければtrue それ以外else
				if ($in_cart->wasRecentlyCreated) {
					$in_cart->item_amount = 1;
				} else {
					$in_cart->increment('item_amount');
				}
				$in_cart->save();
				session()->flash('flash_message', 'カートに追加しました');
				return redirect()->route('cart.index', ['id' => $customer_id]);
			} else {
				//渡ってきた値が存在しなかった場合リダイレクト
				return redirect(url()->previous());
			}
		} else {
			//ログインユーザー以外が送信してきた場合リダイレクト
			return redirect(url()->previous());
		}
	}

	public function delete(Request $request) {
		$customer_id = Auth::id();
		$is_exist_cart = Cart::where('id', $request->cart_id)->where('customer_id', $customer_id)->exists();

		if ($is_exist_cart) {
			Cart::where('id', $request->cart_id)->where('customer_id', $customer_id)->delete();
			session()->flash('flash_message', '削除しました');
			return redirect()->route('cart.index', ['id' => $customer_id]);
		} else {
			session()->flash('flash_message', '不正な送信です');
			return redirect(url()->previous());
		}
	}

	public function logout() {
		Auth::logout();
		return redirect()->to('/');
	}
}































