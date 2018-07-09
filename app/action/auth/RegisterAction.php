<?php

namespace App\Action\Auth;

use App\Action\ApiAction;
use App\Exception\User\UserAlreadyRegisteredException;
use App\Helper\CryptHelper;
use App\Model\User;
use App\Response\TokenResponse;

class RegisterAction extends ApiAction
{
	public function execute()
	{
		if (count($user = User::find(["email = '" . $this->getBodyParam('email') . "'"]))) {
			throw new UserAlreadyRegisteredException();
		}

		$password = CryptHelper::cryptPassword($this->getBodyParam('password'), $this->getParameter('application')->encryptionKey);

		$user = new User();
		$user->create([
			'email' => $this->getBodyParam('email'),
			'password' => $password
		]);

		$jwtConfig = $this->getParameter('jwt');
		$now = time();
		$expires = $now + $jwtConfig->expires;

		$token = $this->getAuth()->make([
			'sub' => $user->id,
			'email' => $user->email,
			'secretKey' => $jwtConfig->secret,
			'iat' => $now,
			'exp' => $expires
		]);

		$this->jsonResponse(
			$this->item([
				'token' => $token,
				'expires' => $expires
			], new TokenResponse()),
			201
		);
	}
}