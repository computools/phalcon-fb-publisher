<?php

namespace App\Exception;

class ConflictApiException extends ApiException
{
	protected $message = 'Conflict';
	protected $statusCode = 409;
}