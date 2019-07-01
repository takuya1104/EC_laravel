<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

	use AuthenticatesUsers;

	protected $redirectTo = '/admin/home';

	public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}

	public function showLoginForm()
	{
		return view('admin.login');
	}

	protected function guard()
	{
		return Auth::guard('admin');
	}

	public function logout(Request $request)
	{
		Auth::guard('admin')->logout();
		$request->session()->flush();
		$request->session()->regenerate();
		return redirect('/admin/login');
	}
}

