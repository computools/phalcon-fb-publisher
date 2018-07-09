<?php

namespace App\Response;

use App\Model\Theme;
use League\Fractal\TransformerAbstract;

class ThemeResponse extends TransformerAbstract
{
	use TransformCollectionTrait;

	public function transform(Theme $theme): array
	{
		return [
			'id' => $theme->id,
			'title' => $theme->title,
			'created_at' => $theme->created_at,
			'updated_at' => $theme->updated_at
		];
	}
}