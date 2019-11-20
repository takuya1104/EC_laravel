<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAddress extends FormRequest
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
			'customer_name' => [
				'required',
				'string',
				'max:255',
				function ($attribute, $value, $fail) {
					if (!preg_match("/^[ぁ-んァ-ヶー一-龠ａ-ｚＡ-Ｚa-zA-Z\s]+$/u", $value)) {
						return $fail('記号は使用できません');
					}
				}
			],
			'postal_code1' => 'required|numeric|digits:3',
			'postal_code2' => 'required|numeric|digits:4',
			'pref' => 'required|',
			'address' => [
				'required',
				'string',
				'max:255',
				function ($attribute, $value, $fail) {
					if (!preg_match("/^[ぁ-んァ-ヶー一-龠ａ-ｚＡ-Ｚa-zA-Z0-9-]+$/u", $value)) {
						return $fail('記号は半角ハイフンのみ使用できます');
					}
				}
			],
			'phone' => 'required|numeric|digits_between:8, 11',
		];
	}
}
