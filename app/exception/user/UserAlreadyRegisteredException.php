<?php

namespace App\Exception\User;

use App\Exception\ConflictApiException;

class UserAlreadyRegisteredException extends ConflictApiException
{
	protected $message = 'User already registered';
}