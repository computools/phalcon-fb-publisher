<?php

namespace App\Action;

class DefaultAction extends ApiAction
{
	public function execute()
	{
		$this->jsonResponse([
			'message' => 'Phalcon API template'
		]);
	}
}