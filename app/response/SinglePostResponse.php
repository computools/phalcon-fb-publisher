<?php

namespace App\Response;

use App\Model\Post;
use League\Fractal\TransformerAbstract;

class SinglePostResponse extends TransformerAbstract
{
	public function transform(Post $post): array
	{
		return [
			'id' => $post->id,
			'title' => $post->title,
			'content' => $post->content,
			'themes' => ($post->themes) ? (new ThemeResponse())->transformCollection($post->themes) : [],
			'created_at' => $post->created_at,
			'updated_at' => $post->updated_at
		];
	}
}