<?php

namespace App\Response;

use App\Model\Publication;
use League\Fractal\TransformerAbstract;

class PublicationResponse extends TransformerAbstract
{
	public function transform(Publication $publication): array
	{
		return [
			'id' => $publication->id,
			'channel' => $publication->channel ? (new ChannelResponse())->transform($publication->channel) : null,
			'post' => $publication->post ? (new PostResponse())->transform($publication->post) : null,
			'success' => $publication->success,
			'facebook_id' => $publication->facebook_id,
			'error_message' => $publication->error_message,
			'created_at' => $publication->created_at,
			'updated_at' => $publication->updated_at
		];
	}
}