<?php

namespace App\Response;

trait TransformCollectionTrait
{
	public function transformCollection($collection)
	{
		$result = [];
		foreach($collection as $item) {
			$result[] = $this->transform($item);
		}
		return $result;
	}
}