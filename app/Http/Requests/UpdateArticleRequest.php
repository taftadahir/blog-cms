<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateArticleRequest extends FormRequest
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
			'new_sys_id' => ['nullable', 'boolean'],
			'same_article_as' => ['nullable', 'integer', 'exists:App\Models\Article,id', 'required_if:new_sys_id,false'],
			'parent_id' => ['nullable', 'integer', 'exists:App\Models\Article,id'],

			'title' => ['nullable', 'string'],
			'slug' => ['nullable', 'string', 'unique:articles,slug,' . $this->route('article')->id],

			'content' => ['nullable', 'string'],
			'content_type' => ['nullable', 'string', 'max:16'],
			'excerpt' => ['string', 'nullable'],

			'keywords' => ['nullable', 'string'],
			'status' => ['nullable', 'string', 'max:16'],
			'disable_comment' => ['nullable', 'boolean'],
			'disable_approval' => ['nullable', 'boolean'],
			'read_time' => ['nullable', 'integer', 'max:255'],
			'version' => ['nullable', 'integer', 'min:0', 'max:255'],
		];
	}
}
