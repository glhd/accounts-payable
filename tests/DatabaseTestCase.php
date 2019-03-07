<?php

namespace Galahad\AccountsPayable\Tests;

use Galahad\AccountsPayable\Tests\Support\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseTestCase extends TestCase
{
	use RefreshDatabase;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->loadLaravelMigrations(['--database' => 'accounts-payable']);
		$this->loadMigrationsFrom(realpath(__DIR__.'/../migrations'));
		$this->artisan('migrate', ['--database' => 'accounts-payable']);
		
		$this->withFactories(__DIR__.'/factories');
	}
	
	protected function login(User $user = null) : self
	{
		return $this->actingAs($user ?? factory(User::class)->create());
	}
}
