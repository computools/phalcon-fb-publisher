<?php

namespace App\Model;

use Phalcon\Mvc\Model;

class Theme extends Model
{
	public $id;

	public $title;

	public function initialize()
	{
		$this->setSource('theme');
		$this->belongsTo('user_id', User::class, 'id', [
			'alias' => 'user'
		]);
		$this->hasManyToMany(
			'id',
			'PostTheme',
			'theme_id',
			'post_id',
			Post::class,
			'id',
			[
				'alias' => 'posts'
			]
		);
	}
}