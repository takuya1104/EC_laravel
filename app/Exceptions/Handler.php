<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
	protected $dontReport = [
		//
	];

	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	public function report(Exception $exception)
	{
		parent::report($exception);
	}

	public function unauthenticated($request, AuthenticationException $exception)
	{
		if($request->expectsJson()){
			return response()->json(['message' => $exception->getMessage()], 401);
		}

		if (in_array('admin', $exception->guards())) {
			return redirect()->guest(route('admin.login'));
		}

		return redirect()->guest(route('login'));
	}

	public function render($request, Exception $exception)
	{
		return parent::render($request, $exception);
		/*
		if($this->isHttpException($e)) {
			// 403
			if($e->getStatusCode() == 403) {
				return response()->view('errors.403');
			}
			// 404
			if($e->getStatusCode() == 404) {
				return response()->view('errors.404');
			}
			// 500
			return response()->view('errors.500');
		}
		return parent::render($request, $e);
		 */
	}
}















