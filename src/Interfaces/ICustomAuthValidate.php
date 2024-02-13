<?php

declare(strict_types=1);

namespace ChrisIdakwo\Auth\Interfaces;

use Illuminate\Contracts\Auth\Authenticatable;

interface ICustomAuthValidate {

	/**
	 * Validate a user's password against password from request data
	 */
	public static function validate(Authenticatable $user, string $password): bool;
}
