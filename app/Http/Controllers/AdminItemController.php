<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
		$item = Item::find($id);
		return view('admin.item_detail', compact('item'));
	}

	public function edit(Request $request, $id) {
		$data_item = Item::findOrFail($id);
		return view('admin.item_edit', compact('data_item'));
	}

	public function editConfirm(Request $request, $id) {
		$item_id = $request->id;
		$item_name = $request->item_name;
		$item_description = $request->item_description;
		$item_stock = $request->item_stock;
		$request->validate([
			'item_name' => 'required|max:255',
			'item_description' => 'required',
			'item_stock' => 'required|numeric|max:999999999|integer',
		]);

		$request->session()->put('name', $item_name);
		$request->session()->put('description', $item_description);
		$request->session()->put('stock', $item_stock);

		return view('admin.item_edit_confirm', compact('item_name', 'item_description', 'item_stock', 'item_id'));
	}
	public function editRegist(Request $request, $id) {
		$item = Item::findOrFail($id);

		$name = $request->session()->get('name');
		$description = $request->session()->get('description');
		$stock = $request->session()->get('stock');

		$item->item_name = $name;
		$item->description = $description;
		$item->stock = $stock;

		$item->save();
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
		]);
		$item = new Item;
		$item->item_name = $request->item_name;
		$item->description = $request->item_description;
		$item->price = $request->item_price;
		$item->stock = $request->item_stock;
		$item->save();
		return redirect()->to('admin/item');
	}

	public function logout(Request $request) {
		Auth::logout();
		return redirect()->to('/admin');
	}
}

