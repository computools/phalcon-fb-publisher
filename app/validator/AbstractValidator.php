<?php

namespace App\Validator;


use App\Exception\BadRequestApiException;
use Phalcon\Validation;

abstract class AbstractValidator implements ValidatorInterface
{
	abstract protected function getValidation(): Validation;

	public function validate(array $body): ?array
	{
		$messages = $this->getValidation()->validate($body);
		$index = 0;
		$result = [];
		while ($message = $messages->offsetGet($index)) {
			$result[$message->getField()][] = $message->getMessage();
			$index ++;
		}
		return count($result) ? $result : null;
	}
}