<?php

namespace Galahad\AccountsPayable\Models;

use Galahad\AccountsPayable\Contracts\Payable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read \Galahad\AccountsPayable\Contracts\Payable $payable
 */
class Taxpayer extends Model
{
	use SoftDeletes;
	
	public function payable() : MorphOne
	{
		return $this->morphOne(Payable::class, 'payable');
	}
}
