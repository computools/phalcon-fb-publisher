<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Response\PostResponse;

class ListPostAction extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		$this->jsonResponse($this->collection($this->getUser()->getPosts([
			'limit' => $this->getUrlParam('per_page', 20),
			'offset' => ($this->getUrlParam('page', 1) - 1) * $this->getUrlParam('per_page', 20)
		]), new PostResponse()));
	}
}