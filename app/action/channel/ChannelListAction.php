<?php

namespace App\Action\Channel;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Model\Channel;
use App\Response\ChannelResponse;

class ChannelListAction extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		$this->jsonResponse(
			$this->collection(
				Channel::find([
					'user_id = :userId:',
					'bind' => [
						'userId' => $this->getUser()->id
					]
				]),
				new ChannelResponse()
			)
		);
	}
}