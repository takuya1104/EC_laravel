<?php
namespace App\Http\Controllers\Admin;

//use Encore\Admin\Facades\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Admin;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$items = Item::all();
		$admin_id = Admin::first()->id;

		return view('admin/home', compact('items', 'admin_id'));
	}
}
