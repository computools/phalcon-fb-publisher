<?php

namespace App\Exception\User;

use App\Exception\UnauthorizedApiException;

class InvalidCredentialsException extends UnauthorizedApiException
{
	protected $message = 'Invalid credentials';
}