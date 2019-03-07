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
	| AccountsPayable Path
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
	| Middleware to pass Accounts Payable requests through. Should at least use auth
	| middleware of some sort.
	|
	*/
	
	'middleware' => ['web', 'auth'],
	
	/*
	|--------------------------------------------------------------------------
	| Authorization
	|--------------------------------------------------------------------------
	|
	| Typically, you will want to register a Policy for access to Accounts Payable.
	| But, to get things started quickly, you can add a list of users that should
	| have full admin access here.
	|
	*/
	
	'admin_ids' => [],
];
