<?php

namespace App\Validator;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\StringLength;

class AuthValidator extends AbstractValidator
{
	protected function getValidation(): Validation
	{
		return (new Validation())
			->add('email', new PresenceOf())
			->add('email', new Email())
			->add('password', new PresenceOf())
			->add('password', new StringLength([
				'min' => 6
			]));
	}
}