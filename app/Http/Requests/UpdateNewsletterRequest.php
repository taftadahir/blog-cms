<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsletterRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
			'email' => ['required', 'string', 'email', 'max:255', 'unique:newsletters,email,' . $this->route('newsletter')->id],
		];
	}
}
