<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Accounts Payable Name
	|--------------------------------------------------------------------------
	|
	| This is the name displayed in the Accounts Payable UI.
	|
	*/
	
	'name' => env('ACCOUNTS_PAYABLE_NAME', 'Accounts Payable'),
	
	/*
	|--------------------------------------------------------------------------
	| Accounts Payable Path
	|--------------------------------------------------------------------------
	|
	| This is the root path to serve Accounts Payable from.
	|
	*/
	
	'path' => env('ACCOUNTS_PAYABLE_PATH', '/accounts-payable'),
	
	/*
	|--------------------------------------------------------------------------
	| Default Guard
	|--------------------------------------------------------------------------
	|
	| This is the guard that Accounts Payable should use when resolving users and
	| checking permissions (defaults to the Laravel "web" guard).
	|
	*/
	
	'guard' => env('ACCOUNTS_PAYABLE_GUARD', 'web'),
	
	/*
	|--------------------------------------------------------------------------
	| Default Middleware
	|--------------------------------------------------------------------------
	|
	| Middleware to pass Accounts Payable requests through. All requrest should
	| at least use auth middleware of some sort. Admin requests may require
	| additional middleware.
	|
	*/
	
	'middleware' => ['web', 'auth'],
	
	/*
	|--------------------------------------------------------------------------
	| Controllers
	|--------------------------------------------------------------------------
	|
	| If you need to deeply integrate Accounts Payable into your existing app,
	| you can implement your own controllers.
	|
	*/
	
	'controllers' => [
		'payouts' => 'Galahad\AccountsPayable\Http\Controller\PayoutMethodsController',
	],
];
