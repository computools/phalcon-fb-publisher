<?php

namespace App\Exception\Theme;

use App\Exception\NotFoundApiException;

class ThemeNotFoundException extends NotFoundApiException
{
	protected $message = 'Theme not found';
}