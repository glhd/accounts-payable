<?php

namespace Galahad\AccountsPayable\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxpayer1099 extends Model
{
	use SoftDeletes;
	
	protected $table = 'taxpayer_1099s';
	
	public function taxpayer() : BelongsTo
	{
		return $this->belongsTo(Taxpayer::class);
	}
}
