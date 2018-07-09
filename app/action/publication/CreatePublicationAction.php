<?php

namespace App\Action\Publication;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Exception\Channel\ChannelNotFoundException;
use App\Exception\Post\PostNotFoundException;
use App\Model\Channel;
use App\Model\Post;
use App\Model\Publication;
use App\Response\PublicationResponse;
use App\Service\FacebookService;

class CreatePublicationAction extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		if (!$post = Post::findFirst([
			'id = :id: AND user_id = :userId:',
			'bind' => [
				'userId' => $this->getUser()->id,
				'id' => $this->getRouteParam('postId')
			]
		])) {
			throw new PostNotFoundException();
		}

		if (!$channel = Channel::findFirst([
			'id = :id: AND user_id = :userId:',
			'bind' => [
				'userId' => $this->getUser()->id,
				'id' => $this->getRouteParam('channelId')
			]
		])) {
			throw new ChannelNotFoundException();
		}

		$publication = new Publication();
		$publication->post = $post;
		$publication->channel = $channel;
		$publication->created_at = (new \DateTime())->format('Y-m-d H:i:s');

		/**
		 * @var FacebookService $facebookService
		 */
		$facebookService = $this->app->getService('facebook');
		$facebookService->publish($publication);
		$publication->save();

		$this->jsonResponse(
			$this->item(
				$publication,
				new PublicationResponse()
			),
			201);
	}
}