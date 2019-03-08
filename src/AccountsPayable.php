<?php

namespace Galahad\AccountsPayable;

use Galahad\AccountsPayable\Events\ServingAccountsPayable;
use Galahad\AccountsPayable\Http\Controller\PayoutMethodsController;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Routing\Router;
use Illuminate\Support\Arr;

class AccountsPayable
{
	/**
	 * @var array
	 */
	protected $config;
	
	/**
	 * @var \Illuminate\Contracts\Events\Dispatcher
	 */
	protected $dispatcher;
	
	/**
	 * @var \Illuminate\Routing\Router
	 */
	protected $router;
	
	public function __construct(Dispatcher $dispatcher, Router $router, array $config)
	{
		$this->dispatcher = $dispatcher;
		$this->router = $router;
		$this->config = $config;
	}
	
	/**
	 * Run callback before serving the AccountsPayable interface
	 *
	 * @param string|callable|array $callback
	 * @return $this
	 */
	public function serving($callback) : self
	{
		$this->dispatcher->listen(ServingAccountsPayable::class, $callback);
		
		return $this;
	}
	
	protected function routes() : self
	{
		$path = Arr::get($this->config, 'path');
		$middleware = Arr::get($this->config, 'middleware');
		
		$this->router
			->middleware($middleware)
			->prefix($path)
			->name('accounts-payable.')
			->resource('payout-methods', Arr::get($this->config, 'controllers.payouts'));
		
		return $this;
	}
}
