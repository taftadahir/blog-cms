<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguageRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'title' => ['nullable', 'string'],
			'iso_code' => ['nullable', 'string', 'unique:languages,iso_code,' . $this->route('language')->id],
			'active' => ['boolean', 'nullable'],
		];
	}
}
