<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
		return $this->user()->can('create', Role::class);
    }

    public function rules()
    {
        return [
			'title' => ['bail', 'string', 'required'],
			'code' => ['bail', 'string', 'required', 'unique:roles,code'],
			'description' => ['string', 'nullable'],
        ];
    }
}
