<?php

namespace Galahad\AccountsPayable\Policies;

use Galahad\AccountsPayable\Contracts\Payable;
use Galahad\AccountsPayable\Models\TaxpayerPayoutMethod;
use Illuminate\Contracts\Auth\Access\Authorizable;

class PayoutMethodPolicy
{
	public function view(Payable $payable, TaxpayerPayoutMethod $method)
	{
		return $method->taxpayer->payable->is($user);
	}
	
	public function create(Payable $payable)
	{
		return true;
	}
	
	public function update(Payable $payable, TaxpayerPayoutMethod $method)
	{
		return $method->taxpayer->payable->is($user);
	}
	
	public function delete(Payable $payable, TaxpayerPayoutMethod $method)
	{
		return $method->taxpayer->payable->is($user);
	}
	
	public function restore(Payable $payable, TaxpayerPayoutMethod $method)
	{
		return $method->taxpayer->payable->is($user);
	}
	
	public function forceDelete(Payable $payable, TaxpayerPayoutMethod $method)
	{
		return false;
	}
}
