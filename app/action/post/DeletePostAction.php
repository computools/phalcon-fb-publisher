<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Exception\Post\PostNotFoundException;
use App\Model\Post;

class DeletePostAction extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		if (!$post = Post::findFirst([
			'id = :id: AND user_id = :userId:',
			'bind' => [
				'id' => $this->getRouteParam('postId'),
				'userId' => $this->getUser()->id
			]
		])) {
			throw new PostNotFoundException();
		}
		$post->delete();
		$this->jsonResponse([], 200);
	}
}