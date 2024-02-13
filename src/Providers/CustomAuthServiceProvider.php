<?php

declare(strict_types=1);

namespace ChrisIdakwo\Auth\Providers;

use Illuminate\Support\ServiceProvider;

class CustomAuthServiceProvider extends ServiceProvider
{
	use BootCustomAuthProvider;

	/**
	 * Boot the service provider
	 */
	public function boot(): void
    {
		$path = dirname(__DIR__, 2) . "/config/custom-auth.php";

		$this->publishes([$path => config_path('custom-auth.php')], "custom-auth");

		$this->bootCustomAuthProvider();
	}

	public function register(): void
    {
		$path = dirname(__DIR__, 2) . "/config/custom-auth.php";

		$this->mergeConfigFrom($path, "custom-auth");
	}
}
