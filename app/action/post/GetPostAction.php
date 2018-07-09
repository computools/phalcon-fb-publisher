<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Exception\Post\PostNotFoundException;
use App\Model\Post;
use App\Response\SinglePostResponse;

class GetPostAction extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		if (!$post = Post::findFirst([
			"id = :postId: AND user_id = :userId:",
			'bind' => [
				'postId' => $this->getRouteParam('postId'),
				'userId' => $this->getUser()->id
			]
		])) {
			throw new PostNotFoundException();
		}

		$this->jsonResponse($this->item($post, new SinglePostResponse()));
	}
}