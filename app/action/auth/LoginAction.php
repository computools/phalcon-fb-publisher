<?php

namespace App\Action\Auth;

use App\Action\ApiAction;
use App\Exception\User\InvalidCredentialsException;
use App\Helper\CryptHelper;
use App\Model\User;
use App\Response\TokenResponse;

class LoginAction extends ApiAction
{
	public function execute()
	{
		if (!count($userResult = User::find(["email = '" . $this->getBodyParam('email') . "'"]))) {
			throw new InvalidCredentialsException();
		}

		$user = $userResult->getFirst();
		if (!CryptHelper::checkPassword($this->getBodyParam('password'), $user->password)) {
			throw new InvalidCredentialsException();
		}

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
			], new TokenResponse())
		);
	}
}