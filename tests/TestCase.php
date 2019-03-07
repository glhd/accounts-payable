<?php

namespace Galahad\AccountsPayable\Tests;

use Galahad\AccountsPayable\Support\Facades\AccountsPayable;
use Galahad\AccountsPayable\Support\AccountsPayableServiceProvider;
use Illuminate\Foundation\Testing\TestResponse;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
	protected function getPackageProviders($app) : array
	{
		return [AccountsPayableServiceProvider::class];
	}
	
	protected function getPackageAliases($app) : array
	{
		return [
			'AccountsPayable' => AccountsPayable::class,
		];
	}
	
	protected function getEnvironmentSetUp($app)
	{
		$app['config']->set('app.key', 'base64:ogrRLheNPge0On8KRJgoIeZ2y3BuubHKnsc37UHFVkA=');
		$app['config']->set('database.default', 'accounts-payable');
		$app['config']->set('database.connections.accounts-payable', [
			'driver' => 'sqlite',
			'database' => ':memory:',
			'prefix' => '',
		]);
	}
}
