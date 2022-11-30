<?php

namespace App\Http\Requests;

use App\Models\Article;
use App\Models\ArticleStatus;
use App\Models\Comment;
use App\Models\Setting;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
	public function authorize()
	{
		$article = Article::where('id', $this->input('article_id'))->first();
		$settingDisableComment = Setting::where('code', 'disable_comment')->first();
		if (($article && $article->disable_comment) || ($settingDisableComment && $settingDisableComment->value == 'true')) {
			return false;
		}

		if ($article && $article->status == ArticleStatus::OUTDATED) {
			return false;
		}

		if (auth()->guest()) {
			$settingDisableGuestComment = Setting::where('code', 'disable_guest_comment')->first();
			return $article && $settingDisableGuestComment && !$article->disable_guest_comment && $settingDisableGuestComment->value == 'false';
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
