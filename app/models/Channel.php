<?php

namespace App\Model;

use Phalcon\Mvc\Model;

class Channel extends Model
{
	public $id;

	public function initialize()
	{
		$this->setSource('channel');
		$this->belongsTo('user_id', User::class, 'id', [
			'alias' => 'user'
		]);
	}
}