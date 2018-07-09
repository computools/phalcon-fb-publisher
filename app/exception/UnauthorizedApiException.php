<?php

namespace App\Exception;

class UnauthorizedApiException extends ApiException
{
	protected $message = 'Unauthorized';
	protected $statusCode = 401;
}