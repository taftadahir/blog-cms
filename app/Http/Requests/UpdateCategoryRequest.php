<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateCategoryRequest extends FormRequest
{
	public function authorize()
	{
		return $this->user()->can('update', Category::class);
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
			'title' => ['nullable', 'bail', 'string', 'required'],
			'slug' => ['nullable', 'bail', 'string', 'required', 'unique:App\Models\Category,slug,' . $this->route('category')->id],
			'description' => ['string', 'nullable'],
			'published' => ['boolean', 'nullable'],
		];
	}
}
