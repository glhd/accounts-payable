<?php

namespace Galahad\AccountsPayable\Exceptions;

use Galahad\AccountsPayable\Contracts\RequiresPayment;
use Galahad\AccountsPayable\Models\TaxpayerLineItem;

class LineItemAlreadyExistsForSource extends \Exception
{
	/**
	 * @var \Galahad\AccountsPayable\Models\TaxpayerLineItem
	 */
	public $line_item;
	
	/**
	 * @var \Galahad\AccountsPayable\Contracts\RequiresPayment
	 */
	protected $source;
	
	public function __construct(TaxpayerLineItem $line_item, RequiresPayment $source)
	{
		parent::__construct('A line item already exists for this source.');
		
		$this->line_item = $line_item;
		$this->source = $source;
	}
}
