<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Model\Post;
use App\Response\PostResponse;

class CreatePostAction extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		$post = new Post();
		$post->create([
			'title' => $this->getBodyParam('title'),
			'content' => $this->getBodyParam('content'),
			'created_at' => (new \DateTime())->format('Y-m-d H:i:s')
		]);
		$post->user = $this->getUser();
		$post->save();
		$this->jsonResponse($this->item($post, new PostResponse()), 201);
	}
}