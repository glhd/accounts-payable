<?php

namespace Galahad\AccountsPayable\Models;

use Galahad\AccountsPayable\Contracts\Payable;
use Galahad\AccountsPayable\Enums\TaxForm;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;

class TaxpayerForm extends Model
{
	use SoftDeletes;
	
	public function taxpayer() : BelongsTo
	{
		return $this->belongsTo(Payable::class);
	}
	
	protected function setFormNameAttribute($form_name) : void
	{
		if ($form_name instanceof TaxForm) {
			$form_name = $form_name->value;
		}
		
		if (!TaxForm::hasValue($form_name)) {
			throw new InvalidArgumentException("");
		}
		
		$this->attributes['form_name'] = $form_name;
	}
	
	protected function getFormNameAttribute($form_name) : TaxForm
	{
		return new TaxForm($form_name);
	}
}
