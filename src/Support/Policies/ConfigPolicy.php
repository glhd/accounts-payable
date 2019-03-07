<?php

namespace Galahad\AccountsPayable\Support\Policies;

use Galahad\AccountsPayable\Contracts\Payable;
use Illuminate\Contracts\Auth\Authenticatable;

class ConfigPolicy
{
	public function view(Authenticatable $user) : bool
	{
		return in_array($user->getAuthIdentifier(), config('accounts-payable.admin_ids', []));
	}
	
	public function create(Authenticatable $user) : bool
	{
		return in_array($user->getAuthIdentifier(), config('accounts-payable.admin_ids', []));
	}
	
	public function update(Authenticatable $user, Payable $taxpayer) : bool
	{
		return in_array($user->getAuthIdentifier(), config('accounts-payable.admin_ids', []));
	}
	
	public function delete(Authenticatable $user, Payable $taxpayer) : bool
	{
		return in_array($user->getAuthIdentifier(), config('accounts-payable.admin_ids', []));
	}
}
