<?php

namespace Galahad\AccountsPayable\Enums;

use BenSampo\Enum\Enum;

final class TaxForm extends Enum
{
	public const IRS_1099 = 'IRS 1099-MISC';
	
	public const IRS_W9 = 'IRS W-9';
	
	protected static function getFriendlyKeyName(string $key) : string
	{
		return str_replace('_', ' ', $key);
	}
}
