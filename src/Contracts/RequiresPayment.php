<?php

namespace Galahad\AccountsPayable\Contracts;

use Galahad\AccountsPayable\Models\TaxpayerLineItem;

interface RequiresPayment
{
	public function getKey();
	
	public function getMorphClass();
	
	public function commitPayment(Payable $payable) : ?TaxpayerLineItem;
	
	public function findLineItem() : ?TaxpayerLineItem;
}
