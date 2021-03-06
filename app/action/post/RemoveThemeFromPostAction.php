<?php

namespace App\Action\Post;

use App\Action\ApiAction;
use App\Action\AuthenticatableInterface;
use App\Exception\Post\PostNotFoundException;
use App\Exception\Theme\ThemeNotFoundException;
use App\Model\Post;
use App\Model\PostTheme;
use App\Model\Theme;
use App\Response\SinglePostResponse;

class RemoveThemeFromPostAction extends ApiAction implements AuthenticatableInterface
{
	public function execute()
	{
		if (!$post = Post::findFirst([
			"id = :postId: AND user_id = :userId:",
			'bind' => [
				'postId' => $this->getRouteParam('postId'),
				'userId' => $this->getUser()->id
			]
		])) {
			throw new PostNotFoundException();
		}

		if (!$theme = Theme::findFirst([
			"id = :themeId: AND user_id = :userId:",
			'bind' => [
				'themeId' => $this->getRouteParam('themeId'),
				'userId' => $this->getUser()->id
			]
		])) {
			throw new ThemeNotFoundException();
		}

		if ($postTheme = PostTheme::findFirst([
			'post_id = :postId: AND theme_id = :themeId:',
			'bind' => [
				'themeId' => $this->getRouteParam('themeId'),
				'postId' => $this->getRouteParam('postId')
			]
		])) {
			$postTheme->delete();
		}

		$this->jsonResponse($this->item($post, new SinglePostResponse()));
	}
}