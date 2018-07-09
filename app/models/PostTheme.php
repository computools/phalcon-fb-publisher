<?php

namespace App\Model;

use Phalcon\Mvc\Model;

class PostTheme extends Model
{
	public function initialize()
	{
		$this->setSource('post_theme');
	}
}