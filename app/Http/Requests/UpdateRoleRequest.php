<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
	public function authorize()
	{
		return $this->user()->can('update', Role::class);
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
