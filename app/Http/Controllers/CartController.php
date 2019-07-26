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
		//hiddenからの値とitemのidの照合
		/*$session_id = $request->session()->get('detail_id');
		dd($session_id);
		if ($item_id != $session_id){
			$request->session()->forget('detail_id');
			return redirect(url()->previous());
		}
		$request->session()->forget('detail_id');*/
		//dd($request->session());

		//ログイン確認
		if (Auth::check()) {
			$customer_id = Auth::id();
			$item_id = decrypt($request->hidden_item_id);

			//アイテムの存在確認 and 在庫確認
			$is_exist_stock = Item::is_exist_stock($item_id);
			if ($is_exist_stock) {
				//レコードが存在していなければINSERT, 存在していればitem_amountをUPDATE
				$in_cart = Cart::firstOrCreate([
					'item_id' => $item_id,
					'customer_id' => $customer_id
				]);
				//存在していなければtrue
				if ($in_cart->wasRecentlyCreated) {
					$in_cart->item_amount = 1;
				} else {
					$in_cart->increment('item_amount');
				}
				$in_cart->save();
				Item::where('id', $item_id)->decrement('stock');

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
		$cart_id = $request->cart_id;
		$customer_id = Auth::id();

		//カート内に存在するitemか確認
		$is_exist_cart = Cart::in_cart($cart_id, $customer_id)->exists();
		if ($is_exist_cart) {
			$cart_in_array = Cart::in_cart($cart_id, $customer_id)->get()->toArray()[0];
			//特定したカートの中のitem_id, item_amount取得
			$in_cart_item_id = $cart_in_array['item_id'];
			$in_cart_item_amount = $cart_in_array['item_amount'];
			//特定したカートを削除
			Cart::in_cart($cart_id, $customer_id)->delete();
			//削除したカートの中のitem_amount分Itemテーブルに追加追加
			Item::where('id', $in_cart_item_id)->increment('stock', $in_cart_item_amount);

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































