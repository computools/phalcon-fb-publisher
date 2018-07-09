<?php

namespace App\Action\Theme;

use App\Action\ApiAction;
use App\Exception\Theme\ThemeNotFoundException;
use App\Model\Theme;

class DeleteThemeAction extends ApiAction
{
	public function execute()
	{
		if (!$theme = Theme::findFirst([
			'id = :id: AND user_id = :userId:',
			'bind' => [
				'id' => $this->getRouteParam('themeId'),
				'userId' => $this->getUser()->id
			]
		])) {
			throw new ThemeNotFoundException();
		}
		$theme->delete();
		$this->jsonResponse([], 200);
	}
}