<?php

declare(strict_types=1);

namespace ChrisIdakwo\Auth\Providers;

use Illuminate\Support\Facades\Auth;

trait BootCustomAuthProvider
{

	protected function bootCustomAuthProvider(): void
    {
		Auth::provider("custom-auth", static function ($app, array $config) {
			return new CustomUserProvider($app->make("hash"), $config["model"]);
		});
	}
}
