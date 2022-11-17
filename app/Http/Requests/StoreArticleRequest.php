<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreArticleRequest extends FormRequest
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
			'new_sys_id' => ['boolean', 'nullable'],
			'same_article_as' => ['nullable', 'integer', 'exists:App\Models\Article,id', 'required_if:new_sys_id,false'],
			'parent_id' => ['nullable', 'integer', 'exists:App\Models\Article,id'],

			'title' => ['bail', 'string', 'required'],
			'slug' => ['bail', 'string', 'required', 'unique:articles,slug'],

			'content' => ['string', 'nullable'],
			'content_type' => ['string', 'nullable', 'max:16'],
			'excerpt' => ['string', 'nullable'],

			'keywords' => ['string', 'nullable'],
			'status' => ['nullable', 'string', 'max:16'],
			'disable_comment' => ['boolean', 'nullable'],
			'disable_approval' => ['boolean', 'nullable'],
			'read_time' => ['integer', 'nullable', 'max:255'],
			'password' => ['nullable', 'string', 'min:8'],
			'version' => ['nullable', 'integer', 'min:0', 'max:255'],
		];
	}
}
