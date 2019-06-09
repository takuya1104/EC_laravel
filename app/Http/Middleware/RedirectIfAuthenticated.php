<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
class RedirectIfAuthenticated
{
	public function handle($request, Closure $next, $guard = null)
	{
		$redir = '/home';
		switch($guard){
			//ログイン時はログイン画面ではなく、/admin/hmeに
		case "admin":
			$redir = '/admin/home';
			break;
		default:
			$redir = '/home';
			break;
		}
		if (Auth::guard($guard)->check()) {
			return redirect($redir);
		}
		return $next($request);
	}
}

