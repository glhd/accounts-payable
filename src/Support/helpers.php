<?php

if (!function_exists('accounts_payable')) {
	function accounts_payable() : Galahad\AccountsPayable\AccountsPayable
	{
		return app('galahad.accounts-payable');
	}
}
