<?php

namespace App\Action\Channel;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Exception\Channel\ChannelAlreadyExistsException;
use App\Model\Channel;
use App\Response\ChannelResponse;
use App\Service\FacebookService;

class CreateChannelAction extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		session_start();
		/**
		 * @var FacebookService $facebookService
		 */
		$facebookService = $this->app->getService('facebook');
		$accessToken = $facebookService->getTokenByCode();
		$clientData = $facebookService->getClientData($accessToken);

		$facebookId = $clientData['id'];

		if (Channel::findFirst([
			'facebook_id = :facebookId:',
			'bind' => [
				'facebookId' => $facebookId
			]
		])) {
			throw new ChannelAlreadyExistsException();
		}

		$channel = new Channel();
		$channel->user = $this->getUser();
		$channel->facebook_id = $facebookId;
		$channel->access_token = $accessToken->getValue();
		$channel->expires_at = $accessToken->getExpiresAt()->format('Y-m-d H:i:s');
		$channel->save();

		$this->jsonResponse($this->item($channel, new ChannelResponse()), 201);
	}
}