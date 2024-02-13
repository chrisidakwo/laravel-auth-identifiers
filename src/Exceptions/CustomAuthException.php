<?php

declare(strict_types=1);

namespace ChrisIdakwo\Auth\Exceptions;

use Exception;

class CustomAuthException extends Exception
{
	/**
	 * @return CustomAuthException
	 */
	public static function invalidValidator(): self
    {
		return new self("The `password_validator` configuration can ony be null, a callable, or an class instance of ICustomAuthValidator");
	}
}
