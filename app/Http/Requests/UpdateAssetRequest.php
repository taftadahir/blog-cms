<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
{
	public function authorize()
	{
		return $this->user()->can('update', Asset::class);
	}

	public function rules()
	{
		return [
			'name' => ['bail', 'string', 'required', 'alpha_dash'],
		];
	}
}
