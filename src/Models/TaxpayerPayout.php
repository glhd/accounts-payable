<?php

namespace Galahad\AccountsPayable\Models;

use Galahad\AccountsPayable\Contracts\Payable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxpayerPayout extends Model
{
	use SoftDeletes;
	
	public function taxpayer() : BelongsTo
	{
		return $this->belongsTo(Payable::class);
	}
	
	public function payout_method() : BelongsTo
	{
		return $this->belongsTo(TaxpayerPayoutMethod::class);
	}
}
