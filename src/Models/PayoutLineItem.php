<?php

namespace Galahad\AccountsPayable\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class PayoutLineItem extends Pivot
{
	public $incrementing = true;
}
