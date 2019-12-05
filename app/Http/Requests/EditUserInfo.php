<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserInfo extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'user_name' => [
				'nullable',
				'string',
				'max:191',
				function ($attribute, $value, $fail) {
					if (!preg_match("/^[ぁ-んァ-ヶー一-龠ａ-ｚＡ-Ｚa-zA-Z\s]+$/u", $value)) {
						return $fail('記号は使用できません');
					}
				}
		],
			'user_email' => 'required|email|max:191',
			'new_password' => 'min:8|string|nullable',
			'confirm_password' => 'min:8|string|nullable|same:new_password',
			'using_password' => 'required|string',
		];
	}
}

