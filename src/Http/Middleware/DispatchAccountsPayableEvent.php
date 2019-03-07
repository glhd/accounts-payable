<?php

namespace Galahad\AccountsPayable\Http\Middleware;

use Galahad\AccountsPayable\Events\ServingAccountsPayable;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;

class DispatchAccountsPayableEvent
{
	/**
	 * @var \Illuminate\Contracts\Events\Dispatcher
	 */
	protected $dispatcher;
	
	public function __construct(Dispatcher $dispatcher)
	{
		$this->dispatcher = $dispatcher;
	}
	
	public function handle(Request $request, callable $next)
	{
		$this->dispatcher->dispatch(new ServingAccountsPayable($request));
		
		return $next($request);
	}
}
