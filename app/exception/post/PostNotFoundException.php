<?php

namespace App\Exception\Post;

use App\Exception\NotFoundApiException;

class PostNotFoundException extends NotFoundApiException
{
	protected $message = 'Post not found';
}