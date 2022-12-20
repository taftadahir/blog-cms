<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguageRequest extends FormRequest
{
	public function authorize()
	{
		return  $this->user()->can('create', $this->route('language'));
	}

	public function rules()
	{
		return [
			'title' => ['bail', 'string', 'required'],
			'iso_code' => ['bail', 'string', 'required', 'unique:languages'],
			'active' => ['boolean', 'nullable'],
		];
	}
}
