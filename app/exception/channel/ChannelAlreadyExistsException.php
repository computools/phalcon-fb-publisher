<?php

namespace App\Exception\Channel;

use App\Exception\ConflictApiException;

class ChannelAlreadyExistsException extends ConflictApiException
{
	protected $message = 'Channel already exists';
}