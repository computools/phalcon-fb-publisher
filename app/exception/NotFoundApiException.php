<?php

namespace App\Exception;

class NotFoundApiException extends ApiException
{
	protected $message = 'Not found';
	protected $statusCode = 404;
}