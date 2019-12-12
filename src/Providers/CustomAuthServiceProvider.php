<?php

namespace ChrisIdakwo\Auth\Providers;

use Illuminate\Support\ServiceProvider;

class CustomAuthServiceProvider extends ServiceProvider {
	use BootCustomAuthProvider;

	/**
	 * Boot the service provider
	 *
	 * @return void
	 */
	public function boot(): void {
		$path = dirname(__DIR__, 2) . "/config/custom-auth.php";

		$this->publishes([$path => config_path('custom-auth.php')], "config");

		$this->mergeConfigFrom($path, "custom-auth");

		$this->bootCustomAuthProvider();
	}
}
