<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'user_id' => ['nullable', 'integer', 'exists:App\Models\User,id'],
			'code' => ['nullable', 'string'],
			'value' => ['string', 'nullable'],
		];
	}
}
