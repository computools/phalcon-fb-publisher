<?php

namespace App\Exception\Channel;

use App\Exception\NotFoundApiException;

class ChannelNotFoundException extends NotFoundApiException
{
	protected $message = 'Channel not found';
}