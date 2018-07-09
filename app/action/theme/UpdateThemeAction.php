<?php

namespace App\Action\Theme;

use App\Action\ApiAction;
use App\Exception\Theme\ThemeNotFoundException;
use App\Model\Theme;
use App\Response\ThemeResponse;

class UpdateThemeAction extends ApiAction
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

		$theme->update([
			'title' => $this->getBodyParam('title'),
			'updated_at' => (new \DateTime())->format('Y-m-d H:i:s')
		]);
		$theme->save();
		$this->jsonResponse($this->item($theme, new ThemeResponse()));
	}
}