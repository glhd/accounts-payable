<?php

namespace Galahad\AccountsPayable;

use Galahad\AccountsPayable\Contracts\Payable;
use Galahad\AccountsPayable\Exceptions\LineItemAlreadyExistsForSource;
use Galahad\AccountsPayable\Models\TaxpayerLineItem;

class PendingLineItem
{
	/**
	 * @var \Galahad\AccountsPayable\Contracts\Payable
	 */
	protected $payable;
	
	/**
	 * @var int
	 */
	protected $cents;
	
	/**
	 * @var string
	 */
	protected $description;
	
	/**
	 * @var bool
	 */
	protected $fail_on_duplicate_source_entry = false;
	
	/**
	 * @var \Galahad\AccountsPayable\Contracts\RequiresPayment
	 */
	protected $source;
	
	/**
	 * @var TaxpayerLineItem
	 */
	protected $committed;
	
	public function __construct(Payable $payable, int $cents, string $description = null)
	{
		$this->payable = $payable;
		$this->cents = $cents;
		$this->description = $description;
	}

	public function forSource(RequiresPayment $source) : self
	{
		$this->source = $source;
		
		return $this;
	}
	
	public function failOnDuplicateSourceEntry() : self
	{
		$this->fail_on_duplicate_source_entry = true;
		
		return $this;
	}
	
	public function commit() : TaxpayerLineItem
	{
		if (!$this->committed) {
			// TODO: Actually save the line item and dispatch any jobs
			$this->committed = new TaxpayerLineItem();
			$this->committed->taxpayer = $this->payable;
			$this->committed->description = $this->description;
			$this->committed->cents = $this->cents;
			
			if ($this->source) {
				$this->committed->source = $this->source;
				
				if ($this->fail_on_duplicate_source_entry && TaxpayerLineItem::forSource($this->source)->exists()) {
					throw new LineItemAlreadyExistsForSource($this->committed, $this->source);
				}
			}
			
			$this->committed->save();
		}
		
		return $this->committed;
	}
	
	public function __destruct()
	{
		$this->commit();
	}
}
