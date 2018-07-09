<?php

namespace App\Response;

use App\Model\Channel;
use App\Model\Post;
use League\Fractal\TransformerAbstract;

class ChannelResponse extends TransformerAbstract
{
	public function transform(Channel $channel): array
	{
		return [
			'id' => $channel->id,
			'facebook_id' => $channel->facebook_id,
			'expired_at' => $channel->expires_at,
			'created_at' => $channel->created_at,
			'updated_at' => $channel->updated_at
		];
	}
}