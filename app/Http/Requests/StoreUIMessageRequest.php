<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUIMessageRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'lang' => ['bail', 'required', 'integer', 'exists:App\Models\Language,id'],
			'code' => ['bail', 'string', 'required'],
			'value' => ['string', 'nullable'],
			'description' => ['string', 'nullable'],
		];
	}
}
