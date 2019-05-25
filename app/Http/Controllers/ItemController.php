<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
	public function index() {
		$var = "Hello Laravel";
		return view('item/index',compact('var'));
	}
}
