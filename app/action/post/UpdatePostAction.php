<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Exception\Post\PostNotFoundException;
use App\Model\Post;
use App\Response\PostResponse;

class UpdatePostAction extends ApiAction implements AuthenticatableInterface
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
		$post->update([
			'title' => $this->getBodyParam('title'),
			'content' => $this->getBodyParam('content'),
			'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
		]);
		$post->save();
		$this->jsonResponse($this->item($post, new PostResponse()));

	}
}