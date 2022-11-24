<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreCategoryRequest extends FormRequest
{
	public function authorize()
	{
		return $this->user()->can('create', Category::class);
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
			'parent_id' => ['nullable', 'integer', 'exists:App\Models\Category,id'],
			'title' => ['bail', 'string', 'required'],
			'slug' => ['bail', 'string', 'required', 'unique:App\Models\Category,slug'],
			'description' => ['string', 'nullable'],
			'published' => ['boolean', 'nullable'],
		];
	}
}
