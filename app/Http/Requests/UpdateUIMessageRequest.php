<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUIMessageRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'lang' => ['nullable', 'integer', 'exists:App\Models\Language,id'],
			'code' => ['nullable', 'string'],
			'value' => ['string', 'nullable'],
			'description' => ['string', 'nullable'],
		];
	}
}
