<?php

declare(strict_types=1);

namespace ChrisIdakwo\Auth;

use InvalidArgumentException;

class Auth
{

	/**
	 * Identifier name.
	 */
	public static string $identifier = 'identifier';

	/**
	 * Get identifier name.
	 *
	 * @return string
	 */
	public static function getIdentifierName(): string
    {
		return static::$identifier;
	}

	/**
	 * Set identifier name.
     *
	 * @throws InvalidArgumentException
	 */
	public static function setIdentifierName(string $identifier): void
    {
		if (empty($identifier)) {
			throw new InvalidArgumentException("Identifier shouldn't be empty.");
		}

		if ($identifier === 'password') {
			throw new InvalidArgumentException("Identifier [{$identifier}] is not allowed!");
		}

		static::$identifier = $identifier;
	}
}
