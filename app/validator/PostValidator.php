<?php

namespace App\Validator;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class PostValidator extends AbstractValidator
{
	public function getValidation(): Validation
	{
		return (new Validation())
			->add('title', new PresenceOf())
			->add('content', new PresenceOf());
	}
}