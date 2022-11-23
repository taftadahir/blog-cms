<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'user_id' => ['nullable', 'integer', 'exists:App\Models\User,id'],
			'code' => ['bail', 'string', 'required'],
			'value' => ['string', 'nullable'],
		];
	}
}
