<?php

namespace ChrisIdakwo\Auth\Interfaces;

interface ICustomAuthValidate {

	/**
	 * Validate a user's password against password from request data
	 *
	 * @param $user
	 * @param $password
	 * @return bool
	 */
	public static function validate($user, $password): bool;
}
