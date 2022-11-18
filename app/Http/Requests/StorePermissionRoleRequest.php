<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRoleRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'permission_id' => ['required', 'integer', 'exists:App\Models\Permission,id'],
			'role_id' => ['required', 'integer', 'exists:App\Models\Role,id'],
		];
	}
}
