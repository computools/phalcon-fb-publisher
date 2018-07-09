<?php

namespace App\Action\Theme;

use App\Action\ApiAction;
use App\Response\ThemeResponse;

class ListThemesAction extends ApiAction
{
	public function execute()
	{
		$this->jsonResponse(
			$this->collection($this->getUser()->getThemes([
				'limit' => $this->getUrlParam('per_page', 20),
				'offset' => ($this->getUrlParam('page', 1) - 1) * $this->getUrlParam('per_page', 20)
			]), new ThemeResponse())
		);
	}
}