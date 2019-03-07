<?php

namespace Galahad\AccountsPayable\Support;

use Galahad\AccountsPayable\Contracts\Payable;
use Galahad\AccountsPayable\Events\ServingAccountsPayable;
use Galahad\AccountsPayable\AccountsPayable;
use Galahad\AccountsPayable\Support\Policies\ConfigPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class AccountsPayableServiceProvider extends ServiceProvider
{
	public function boot() : void
	{
		require_once rtrim(__DIR__, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR.'helpers.php';
		
		$this->bootConfig()
			->bootPermissions($this->app->make(Gate::class), $this->app->make(Dispatcher::class))
			->bootRoutes($this->app->make(Registrar::class))
			->bootBlade($this->app->make(BladeCompiler::class))
			->bootViews()
			->bootMigrations()
			->bootPublic();
	}
	
	public function register() : void
	{
		$this->mergeConfigFrom($this->basePath('config/accounts-payable.php'), 'accounts-payable');
		
		$this->app->singleton('glhd.accounts-payable', function(Application $app) {
			return new AccountsPayable(
				$app->make(Dispatcher::class),
				$app['config']['accounts-payable']
			);
		});
		
		$this->app->alias('glhd.accounts-payable', AccountsPayable::class);
	}
	
	/**
	 * Like Laravel Nova, AccountsPayable allows access in local development by default
	 *
	 * @param \Illuminate\Contracts\Auth\Access\Gate $gate
	 */
	protected function bootPermissions(Gate $gate, Dispatcher $dispatcher) : self
	{
		$gate->define('_viewAccountsPayable', function() use ($gate) {
			if ($gate->has('viewAccountsPayable')) {
				return $gate->authorize('viewAccountsPayable');
			}
			
			return $this->app->isLocal() || in_array(Auth::id(), config('accounts-payable.admin_ids', []));
		});
		
		$dispatcher->listen(ServingAccountsPayable::class, function() use ($gate) {
			if (null === $gate->getPolicyFor(Payable::class)) {
				$gate->policy(Payable::class, ConfigPolicy::class);
			}
		});
		
		return $this;
	}
	
	protected function bootConfig() : self
	{
		if (method_exists($this->app, 'configPath')) {
			$this->publishes([
				$this->basePath('/config/accounts-payable.php') => $this->app->configPath('accounts-payable.php'),
			], 'accounts-payable-config');
		}
		
		return $this;
	}
	
	protected function bootRoutes(Registrar $registrar) : self
	{
		$path = $this->config('path');
		
		// if ($registrar instanceof Router) {
		// 	$registrar
		// 		->redirect($path, "{$path}/web")
		// 		->middleware($this->config('middleware'));
		// }
		//
		// $registrar
		// 	->get("{$path}/web/{any?}", FrontendController::class)
		// 	->middleware($this->config('middleware'))
		// 	->name('accounts-payable.frontend')
		// 	->where('any', '.*');
		
		return $this;
	}
	
	protected function bootBlade(BladeCompiler $compiler) : self
	{
		// $compiler->directive('accounts-payable', function ($expression) {
		// 	$view_class = AccountsPayableView::class;
		// 	$factory_class = Factory::class;
		// 	$base_path = $this->basePath();
		/*	return "<?php echo (new {$view_class}(app('glhd.accounts-payable.resolvers.content_type'), app({$factory_class}::class), '{$base_path}', $expression)); ?>";*/
		// });
		
		return $this;
	}
	
	protected function bootViews() : self
	{
		$path = $this->basePath('resources/views');
		
		$this->loadViewsFrom($path, 'accounts-payable');
		
		if (method_exists($this->app, 'resourcePath')) {
			$this->publishes([
				$path => $this->app->resourcePath('views/vendor/accounts-payable'),
			], 'accounts-payable-views');
		}
		
		return $this;
	}
	
	protected function bootMigrations() : self
	{
		if (method_exists($this->app, 'databasePath')) {
			$this->publishes([
				$this->basePath('migrations/') => $this->app->databasePath('migrations')
			], 'accounts-payable-migrations');
		}
		
		return $this;
	}
	
	protected function bootPublic() : self
	{
		if (method_exists($this->app, 'publicPath')) {
			$this->publishes([
				$this->basePath('resources/public') => $this->app->publicPath('vendor/accounts-payable')
			], 'accounts-payable-public');
		}
		
		return $this;
	}
	
	protected function basePath(string $path = null) : string
	{
		$base_path = rtrim(dirname(__DIR__, 2), DIRECTORY_SEPARATOR);
		
		return null === $path
			? $base_path
			: $base_path.DIRECTORY_SEPARATOR.ltrim($path, DIRECTORY_SEPARATOR);
	}
	
	protected function config($key, $default = null)
	{
		return $this->app->make(Repository::class)->get("accounts-payable.{$key}", $default);
	}
}
