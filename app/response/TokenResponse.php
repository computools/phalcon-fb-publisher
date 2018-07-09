<?php

namespace App\Response;

use League\Fractal\TransformerAbstract;

class TokenResponse extends TransformerAbstract
{
	public function transform(array $data): array
	{
		return [
			'token' => $data['token'],
			'expires' => $data['expires']
		];
	}
}