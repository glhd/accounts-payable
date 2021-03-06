<?php

namespace Galahad\AccountsPayable\Http\Middleware;

use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Http\Request;

class Authorize
{
	/**
	 * @var \Illuminate\Contracts\Auth\Access\Gate
	 */
	protected $gate;
	
	public function __construct(Gate $gate)
	{
		$this->gate = $gate;
	}
	
	public function handle(Request $request, callable $next)
	{
		$this->gate->authorize('_viewAccountsPayable');
		
		return $next($request);
	}
}
