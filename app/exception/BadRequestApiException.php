<?php

namespace App\Exception;

class BadRequestApiException extends ApiException
{
	protected $message = 'Bad request';
	protected $statusCode = 400;

	public function __construct()
	{
		parent::__construct();
	}
}