<?php

namespace App\Helper;

use Phalcon\Crypt;
use Phalcon\Security\Random;

class CryptHelper
{
	private static $cost = PASSWORD_BCRYPT_DEFAULT_COST;

	public static function cryptPassword(string $password, string $encryptionKey): string
	{
		return password_hash($password, PASSWORD_BCRYPT, [
			'cost' => self::$cost,
			'salt' => (new Crypt())->encryptBase64(
				(new Random())->bytes(32),
				$encryptionKey
			)
		]);
	}

	public static function checkPassword(string $password, string $hash): bool
	{
		return password_verify($password, $hash);
	}


}