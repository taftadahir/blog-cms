<?php

namespace App\Http\Requests;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
	public function authorize()
	{
		if (auth()->guest()) {
			$article = Article::where('id', $this->input('article_id'))->first();
			$setting = Setting::where('code', 'disable_guest_comment')->first();

			return $article && $setting && !$article->disable_guest_comment && $setting->value == 'false';
		} else {
			return  $this->user()->can('create', Comment::class);
		}
	}

	public function rules()
	{
		$rules = [
			'parent_id' => ['nullable', 'integer', 'exists:App\Models\Comment,id'],
			'article_id' => ['bail', 'required', 'integer', 'exists:App\Models\Article,id'],
			'content' => ['required', 'string'],
		];

		if (auth()->guest()) {
			$rules['name'] = ['bail', 'required', 'string', 'max:255'];
			$rules['email'] = ['bail', 'required', 'string', 'email', 'max:255'];
		}

		return $rules;
	}
}
