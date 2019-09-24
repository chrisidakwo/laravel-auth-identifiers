<?php

namespace ChrisIdakwo\Auth\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class CustomAuthServiceProvider extends ServiceProvider {
	use BootCustomAuthProvider;

	/**
	 * Boot the service provider
	 *
	 * @return void
	 * @throws BindingResolutionException
	 */
	public function boot(): void {
		$this->mergeConfigFrom(__DIR__ . "/../../config/custom-auth.php", "custom-auth");

		$this->publishes([
			__DIR__ . "/../../config/" => $this->app->make("path.config")
		], "config");

		$this->bootCustomAuthProvider();
	}
}
