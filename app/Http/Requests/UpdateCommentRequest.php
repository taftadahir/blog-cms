<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCommentRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'parent_id' => ['nullable', 'integer', 'exists:App\Models\Comment,id'],
			'article_id' => ['nullable', 'integer', 'exists:App\Models\Article,id'],
			'content' => ['nullable', 'string'],
			'status' => ['nullable', 'string'],
		];
	}
}
