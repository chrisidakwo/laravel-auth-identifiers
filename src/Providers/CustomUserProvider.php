<?php

namespace ChrisIdakwo\Auth\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;
use ChrisIdakwo\Auth\Auth;
use ChrisIdakwo\Auth\Exceptions\CustomAuthException;
use ChrisIdakwo\Auth\Interfaces\ICustomAuthValidate;

class CustomUserProvider extends EloquentUserProvider {
	public function retrieveByCredentials(array $credentials) {
		$name = Auth::getIdentifierName();

		// Should in case the key from request that is used to hold the login credentials
		// doesn't match the set Auth::$identifier, then return the
		// Laravel's default retrieveByCredentials() method from EloquentUserProvider
		if (!isset($credentials[$name]) || empty($credentials[$name])) {
			return parent::retrieveByCredentials($credentials);
		}

		$identifier = $credentials[$name];
		unset($credentials[$name]);

		// First we will add each credential element to the query as a where clause.
		// Then we can execute the query and, if we found a user, return it in an
		// Eloquent User "model" that will be utilized by the Guard instances.
		$query = $this->createModel()
			->newQuery()
			->findByIdentifiers($identifier);

		foreach ($credentials as $key => $value) {
			if (!Str::contains($key, 'password')) {
				$query->where($key, $value);
			}
		}

		return $query->first();
	}

	/**
	 * Validate a user against the given credentials.
	 *
	 * @param Authenticatable $user
	 * @param array $credentials
	 * @return bool
	 * @throws CustomAuthException
	 */
	public function validateCredentials(Authenticatable $user, array $credentials): bool {
		$customValidator = Config::get("custom-auth.password_validator");

		if ($customValidator !== null) {
			if (is_callable($customValidator)) {
				return $customValidator($user, $credentials["password"]);
			}

			if ($customValidator instanceof ICustomAuthValidate) {
				return $customValidator::validate($user, $credentials["password"]);
			}

			throw CustomAuthException::invalidValidator();
		}

		return $this->hasher->check($credentials["password"], $user->getAuthPassword());
	}
}
