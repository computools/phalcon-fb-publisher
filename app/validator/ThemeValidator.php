<?php

namespace App\Validator;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;

class ThemeValidator extends AbstractValidator
{
	public function getValidation(): Validation
	{
		return (new Validation())
			->add('title', new PresenceOf());
	}
}