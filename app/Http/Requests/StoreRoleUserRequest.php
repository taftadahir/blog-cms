<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
			'user_id' => ['required', 'integer', 'exists:App\Models\User,id'],
			'role_id' => ['required', 'integer', 'exists:App\Models\Role,id'],
        ];
    }
}
