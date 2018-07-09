<?php

namespace App\Model;

use Phalcon\Mvc\Model;

class Post extends Model
{
	public $id;

	public $user_id;

	public function initialize()
	{
		$this->setSource('post');
		$this->belongsTo('user_id', User::class, 'id', [
			'alias' => 'user'
		]);
		$this->hasManyToMany(
			'id',
			PostTheme::class,
			'post_id',
			'theme_id',
			Theme::class,
			'id',
			[
				'alias' => 'themes'
			]
		);
	}
}