<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
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
