<?php

namespace App\Validator;

class CustomValidator extends \Illuminate\Validation\Validator
{

	public function validateJpZipCode($attribute, $value, $parameters)
	{
		return preg_match('/^\d{3}-\d{4}$/', $value);
	}

	public function validatePasswordCheck($attribute, $value, $parameters)
	{
		return preg_match('/^[A-Za-z\d]{8,16}$/', $value);
	}
	public function validateKana($attribute, $value, $parameters)
	{
		if (mb_strlen($value) > 100) {
			return false;
		}

		if (preg_match('/[^ぁ-んー]/u', $value) !== 0) {
			return false;
		}

		return true;
	}
}
