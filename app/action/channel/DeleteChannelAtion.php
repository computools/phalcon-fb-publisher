<?php

namespace App\Action\Channel;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Exception\Channel\ChannelNotFoundException;
use App\Model\Channel;

class DeleteChannelAtion extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		if (!$channel = Channel::findFirst([
			'user_id = :userId: AND id = :id:',
			'bind' => [
				'userId' => $this->getUser()->id,
				'id' => $this->getRouteParam('channelId')
			]
		])) {
			throw new ChannelNotFoundException();
		}

		$channel->delete();
		$this->jsonResponse([]);
	}
}