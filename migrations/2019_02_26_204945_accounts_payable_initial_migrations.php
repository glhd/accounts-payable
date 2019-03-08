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
		// Represents a W-9 form
		Schema::create('taxpayers', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->morphs('payable');
			$table->text('data');
			$table->timestamps();
			$table->softDeletes();
		});
		
		// TODO: Forms for a tax year cannot be generated if any payouts for that year are still pending
		
		// Represents a 1099-MISC for a specific tax year
		Schema::create('taxpayer_1099s', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('taxpayer_id')->index();
			$table->unsignedSmallInteger('tax_year')->index();
			$table->unsignedInteger('other_income_cents');
			$table->string('disk')->nullable();
			$table->string('path')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		
		// TODO: Line items cannot be updated once payout_id is not null
		
		Schema::create('taxpayer_line_items', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('taxpayer_id')->index();
			$table->string('description')->nullable();
			$table->bigInteger('cents');
			$table->nullableMorphs('source');
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::create('taxpayer_payouts', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('taxpayer_id')->index();
			$table->unsignedBigInteger('payout_method_id')->index();
			$table->string('status')->default('pending');
			$table->text('provider_payload')->nullable();
			$table->timestamp('completed_at')->nullable();
			$table->timestamp('cancelled_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
		
		Schema::create('taxpayer_payout_line_items', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('payout_id')->index();
			$table->unsignedBigInteger('line_item_id')->index();
			$table->timestamps();
		});
		
		// TODO: There must be one payout method where is_default = true, but no more than one
		
		Schema::create('taxpayer_payout_methods', function(Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('taxpayer_id')->index();
			$table->string('provider'); // Lob, Stripe, PayPal, Venmo?
			$table->text('configuration'); // JSON
			$table->timestamps();
			$table->softDeletes();
		});
		
		// TODO: When a payout is cancelled, the line item's payout_id should be set to null
		
		// Schema::create('taxpayer_payouts', function(Blueprint $table) {
		// 	$table->bigIncrements('id');
		// 	$table->unsignedBigInteger('taxpayer_id')->index();
		// 	$table->unsignedBigInteger('payout_method_id')->index();
		// 	$table->unsignedBigInteger('form_id')->nullable();
		// 	$table->string('status')->default('pending');
		// 	$table->text('provider_payload')->nullable();
		// 	$table->timestamp('completed_at')->nullable();
		// 	$table->timestamp('cancelled_at')->nullable();
		// 	$table->timestamps();
		// 	$table->softDeletes();
		// });
	}
	
	/**
	 * Reverse migrations
	 */
	public function down()
	{
		Schema::dropIfExists('taxpayer_payouts');
		Schema::dropIfExists('taxpayer_payout_methods');
		Schema::dropIfExists('taxpayer_line_items');
		Schema::dropIfExists('taxpayer_forms');
		Schema::dropIfExists('taxpayer');
	}
}
