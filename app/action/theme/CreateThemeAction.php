<?php

namespace App\Action\Theme;

use App\Action\ApiAction;
use App\Model\Theme;
use App\Response\ThemeResponse;

class CreateThemeAction extends ApiAction
{
	public function execute()
	{
		$theme = new Theme();
		$theme->create([
			'title' => $this->getBodyParam('title')
		]);
		$theme->user = $this->getUser();
		$theme->save();
		$this->jsonResponse($this->item($theme, new ThemeResponse()), 201);
	}
}
