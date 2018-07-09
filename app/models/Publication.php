<?php

namespace App\Model;

use Phalcon\Mvc\Model;

class Publication extends Model
{
	public $id;

	public function initialize()
	{
		$this->setSource('publication');
		$this->belongsTo('post_id', Post::class, 'id', [
			'alias' => 'post'
		]);
		$this->belongsTo('channel_id', Channel::class, 'id', [
			'alias' => 'channel'
		]);
	}
}