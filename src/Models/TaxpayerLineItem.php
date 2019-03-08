<?php

namespace Galahad\AccountsPayable\Models;

use Galahad\AccountsPayable\Contracts\RequiresPayment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static forSource(RequiresPayment $source)
 */
class TaxpayerLineItem extends Model
{
	use SoftDeletes;
	
	public function taxpayer() : BelongsTo
	{
		return $this->belongsTo(Taxpayer::class);
	}
	
	public function scopeForSource(Builder $query, RequiresPayment $source) : Builder
	{
		return $query
			->where('source_id', '=', $source->getKey())
			->where('source_type', '=', $source->getMorphClass());
	}
}
