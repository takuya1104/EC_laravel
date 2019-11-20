<?php

return [


	'defaults' => [
		'guard' => 'user',
		'passwords' => 'users',
	],


	'guards' => [
		'web' => [
			'driver' => 'session',
			'provider' => 'users',
		],

		'api' => [
			'driver' => 'token',
			'provider' => 'users',
		],
		'user' => [
			'driver' => 'session',
			'provider' => 'users',
		],
		'admin' => [
			'driver' => 'session',
			'provider' => 'admins',
		],
	],

	'providers' => [
		'users' => [
			'driver' => 'eloquent',
			'model' => App\User::class,
		],
		'admins' => [
			'driver' => 'eloquent',
			'model' => App\Admin::class,
		],
	],


	'passwords' => [
		'users' => [
			'provider' => 'users',
			'table' => 'password_resets',
			'expire' => 30,
		],
	],

];
