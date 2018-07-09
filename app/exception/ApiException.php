<?php

namespace App\Exception;

class ApiException extends \Exception
{
	protected $message = 'Internal server error';
	protected $statusCode = 500;

	public function __construct($message = null)
	{
		parent::__construct($message ? $message : $this->message, $this->statusCode);
	}
}