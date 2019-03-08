<?php

namespace Galahad\AccountsPayable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxpayerPayout extends Model
{
	use SoftDeletes;
	
	public function taxpayer() : BelongsTo
	{
		return $this->belongsTo(Taxpayer::class);
	}
	
	public function payout_method() : BelongsTo
	{
		return $this->belongsTo(TaxpayerPayoutMethod::class);
	}
	
	public function line_items() : BelongsToMany
	{
		return $this->belongsToMany(TaxpayerLineItem::class, 'taxpayer_payout_line_items')
			->using(PayoutLineItem::class)
			->withTimestamps();
	}
}
