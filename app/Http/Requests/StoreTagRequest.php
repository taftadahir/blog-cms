<?php

namespace App\Http\Requests;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreTagRequest extends FormRequest
{
	public function authorize()
	{
		return $this->user()->can('create', Tag::class);
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
			'title' => ['bail', 'string', 'required'],
			'slug' => ['bail', 'string', 'required', 'unique:App\Models\Tag,slug'],
			'description' => ['string', 'nullable'],
			'published' => ['boolean', 'nullable'],
		];
	}
}
