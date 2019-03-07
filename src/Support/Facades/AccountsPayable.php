<?php

namespace Galahad\AccountsPayable\Support\Facades;

use Illuminate\Support\Facades\Facade;

class AccountsPayable extends Facade
{
	protected static function getFacadeAccessor() : string
	{
		return 'glhd.accounts-payable';
	}
}
