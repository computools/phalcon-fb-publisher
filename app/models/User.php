<?php

namespace App\Model;

use Phalcon\Mvc\Model;

class User extends Model
{
	public $id;

	public $posts;

	public $themes;

	public function initialize()
	{
		$this->setSource('users');
		$this->hasMany(
			'id',
			Post::class,
			'user_id',
			[
				'alias' => 'posts'
			]
		);
		$this->hasMany(
			'id',
			Theme::class,
			'user_id',
			[
				'alias' => 'themes'
			]
		);
	}
}