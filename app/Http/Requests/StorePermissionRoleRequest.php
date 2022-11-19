<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRoleRequest extends FormRequest
{
	public function authorize()
	{
		return $this->user()->can('addPermissionToRole', Role::class);
	}

	public function rules()
	{
		return [
			'permission_id' => ['required', 'integer', 'exists:App\Models\Permission,id'],
			'role_id' => ['required', 'integer', 'exists:App\Models\Role,id'],
		];
	}
}
