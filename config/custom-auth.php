<?php


return [
	/**
	 * Custom validation implementation.
	 *
	 * You can define a closure function or use a class that implements from the ICustomAuthValidate interface
	 *
	 * If a closure, then the first parameter is an instance of an Authenticable and the second parameter
	 * is the password from the login POST request
	 */
	"password_validator" => null,
];
