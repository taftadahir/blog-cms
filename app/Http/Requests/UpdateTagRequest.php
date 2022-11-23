<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateTagRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	protected function prepareForValidation()
	{
		$this->merge([
			'slug' => Str::slug($this->input('slug'))
		]);
	}

	public function rules()
	{
		return [
			'title' => ['string', 'nullable'],
			'slug' => ['string', 'nullable', 'unique:App\Models\Tag,slug,' . $this->route('tag')->id],
			'description' => ['string', 'nullable'],
			'published' => ['boolean', 'nullable'],
		];
	}
}
