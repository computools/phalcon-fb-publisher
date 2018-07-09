<?php

namespace App\Action\Channel;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Service\FacebookService;

class GetChannelLinkAction extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		session_start();
		/**
		 * @var FacebookService $facebookService
		 */
		$facebookService = $this->app->getService('facebook');
		$this->jsonResponse([
			'link' => $facebookService->getAuthUrl()
		]);
	}
}