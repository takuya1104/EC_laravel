<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Item;
use App\Admin;
use Validator;
class AdminItemController extends Controller
{

	public function index() {
		$items = Item::simplePaginate(10);
		return view('admin.item_index', compact('items'));
	}

	public function detail($id) {
		$check_id = Item::is_exist_id($id);
		if ($check_id) {
			$item = Item::find($id);
			return view('admin.item_detail', compact('item'));
		} else {
			return redirect(url()->previous());
		}
	}

	public function edit(Request $request, $id) {
		$data_item = Item::findOrFail($id);

		$session_file_name = $request->session()->get('file_name');
		$registered_file_name = Item::where('id', $id)->value('file_name');
		if ($session_file_name !== NULL && $registered_file_name !== $session_file_name) {
			Storage::delete('public/' . $session_file_name);
		}

		return view('admin.item_edit', compact('data_item'));
	}

	public function editConfirm(Request $request, $id) {
		$item_name = $request->item_name;
		$item_description = $request->item_description;
		$item_stock = $request->item_stock;
		$item_file = $request->item_file;
		$item_del = $request->file_del;
		$request->validate([
			'item_name' => 'required|max:255',
			'item_description' => 'required',
			'item_stock' => 'required|numeric|max:999999999|integer',
		]);

		if ($item_del == 'on' && $item_file == NULL) {
			session()->flash('flash_message', '削除する画像がありません');
			return redirect(url()->previous());
		}

		//ファイルが選択されていれば、削除チェックが有効でも画像更新
		//削除ボタンが有効で且つファイルが選択されていなければ画像ファイルはNULL
		//画像に更新が何もなければ、DBから既存で登録されているファイル名を取得
		if (!is_null($item_file)) {
			$extension = $request->file('item_file')->getClientOriginalExtension();
			$item_file_name = md5(uniqid(rand(),1)) . '.' . $extension;
			$request->file('item_file')->storeAs('public', $item_file_name);
		} else {
			if ($item_del == 'on') {
				$item_file_name = NULL;
				$request->session()->put('file_name', $item_file_name);
			} else {
				$item_file_name = Item::where('id', $id)->value('file_name');
			}
		}

		$request->session()->put('name', $item_name);
		$request->session()->put('description', $item_description);
		$request->session()->put('stock', $item_stock);
		$request->session()->put('file_name', $item_file_name);
		$request->session()->put('del_flg', $item_del);

		return view('admin.item_edit_confirm', compact('item_name', 'item_description', 'item_stock', 'id', 'item_file_name'));
	}

	public function editRegist(Request $request, $id) {

		$name = $request->session()->get('name');
		$description = $request->session()->get('description');
		$stock = $request->session()->get('stock');
		$file_name = $request->session()->get('file_name');

		$item = Item::findOrFail($id);
		$item->item_name = $name;
		$item->description = $description;
		$item->stock = $stock;
		$item->file_name = $file_name;

		//削除フラグが立っていて新しい画像が登録された時　データベースから取得削除
		$registered_file_name = Item::where('id', $id)->value('file_name');
		if ($file_name !== $registered_file_name) {
			Storage::delete('public/' . $registered_file_name);
		}
		$item->save();
		$request->session()->forget('name');
		$request->session()->forget('description');
		$request->session()->forget('stock');
		$request->session()->forget('file_name');
		session()->flash('flash_message', '編集が完了しました');
		return redirect()->to('admin/item');
	}

	public function add() {
		return view('admin.item_add');
	}

	public function addConfirm(Request $request) {
		$request->validate([
			'item_name' => 'required|max:255',
			'item_description' => 'required',
			'item_price' => 'required|numeric|max:999999999|integer|min:1',
			'item_stock' => 'required|numeric|max:999999999|integer',
			'item_file' => 'file|image|mimes:jpeg,png,jpg,gif|max:3000',
		]);
		$extension = $request->file('item_file')->getClientOriginalExtension();
		$new_file_name = md5(uniqid(rand(),1)) . '.' . $extension;

		$request->file('item_file')->storeAs('public', $new_file_name);
		$item = new Item;
		$item->item_name = $request->item_name;
		$item->description = $request->item_description;
		$item->price = $request->item_price;
		$item->stock = $request->item_stock;
		$item->file_name = $new_file_name;
		$item->save();
		session()->flash('flash_message', '商品を追加しました');
		return redirect()->to('admin/item');
	}

	public function logout(Request $request) {
		Auth::logout();
		return redirect()->to('/admin');
	}
}

