<?php

namespace Galahad\AccountsPayable\Events;

use Illuminate\Http\Request;

class ServingAccountsPayable
{
	/**
	 * The current request
	 *
	 * @var \Illuminate\Http\Request
	 */
	public $request;
	
	/**
	 * Constructor
	 *
	 * @param \Illuminate\Http\Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
	}
}
