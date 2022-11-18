<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'title' => ['nullable', 'string'],
			'code' => ['nullable', 'string', 'unique:roles,code,' . $this->route('role')->id],
			'description' => ['string', 'nullable'],
		];
	}
}
