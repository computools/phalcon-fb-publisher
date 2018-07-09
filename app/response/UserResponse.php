<?php

namespace App\Response;

use App\Model\User;
use League\Fractal\TransformerAbstract;

class UserResponse extends TransformerAbstract
{
	public function transform(User $user)
	{
		return [
			'id' => $user->id,
			'email' => $user->email,
			'created_at' => $user->creted_at,
			'updated_at' => $user->updated_at
		];
	}
}