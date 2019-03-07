<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccountsPayableDefaultContentSchema extends Migration
{
	/**
	 * Run migrations
	 */
	public function up()
	{
		Schema::create('taxpayer_forms', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('taxpayer_id')->index();
			$table->string('form_name')->index();
			$table->string('disk');
			$table->string('path');
			$table->text('data');
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::create('taxpayer_ledger', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('payout_id')->index();
			$table->unsignedBigInteger('taxpayer_id')->index();
			$table->unsignedInteger('payment_cents');
			$table->unsignedInteger('tax_withheld_cents')->default(0);
			$table->boolean('for_direct_consumer_resale')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::create('taxpayer_payout_methods', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('taxpayer_id')->index();
			$table->string('provider'); // Lob, Stripe, PayPal, Venmo?
			$table->text('configuration'); // JSON
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::create('taxpayer_payouts', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('taxpayer_id')->index();
			$table->unsignedBigInteger('payout_method_id')->index();
			$table->unsignedBigInteger('form_id')->nullable();
			$table->string('status')->default('pending');
			$table->timestamp('completed_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}
	
	/**
	 * Reverse migrations
	 */
	public function down()
	{
		Schema::dropIfExists('taxpayer_payouts');
		Schema::dropIfExists('taxpayer_payout_methods');
		Schema::dropIfExists('taxpayer_ledger');
		Schema::dropIfExists('taxpayer_forms');
	}
}
