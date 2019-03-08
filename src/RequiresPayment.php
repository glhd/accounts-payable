<?php

namespace Galahad\AccountsPayable;

use Galahad\AccountsPayable\Contracts\Payable;
use Galahad\AccountsPayable\Models\TaxpayerLineItem;

trait RequiresPayment
{
	public function commitPayment(Payable $payable) : ?TaxpayerLineItem
	{
		if ($pending = $this->preparePayment($payable)) {
			return $pending->commit();
		}
		
		return null;
	}
	
	public function findLineItem() : ?TaxpayerLineItem
	{
		return TaxpayerLineItem::forSource($this)->first();
	}
	
	abstract protected function preparePayment(Payable $payable) : ?PendingLineItem;
}
