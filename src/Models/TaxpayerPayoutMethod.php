<?php

namespace Galahad\AccountsPayable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property-read \Galahad\AccountsPayable\Models\Taxpayer $taxpayer
 */
class TaxpayerPayoutMethod extends Model
{
	use SoftDeletes;
	
	public function taxpayer() : BelongsTo
	{
		return $this->belongsTo(Taxpayer::class);
	}
}
