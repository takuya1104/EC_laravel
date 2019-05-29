<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
	public function index() {
		$items = \App\Item::all();
		return view('item/index', compact('items'));
	}
	public function detail($id) {
		$item = \App\Item::find($id);
		return view('item/detail', compact('item'));
	}
}
