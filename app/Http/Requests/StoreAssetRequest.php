<?php

namespace App\Http\Requests;

use App\Models\Asset;
use Illuminate\Foundation\Http\FormRequest;

class StoreAssetRequest extends FormRequest
{
	public function authorize()
	{
		return $this->user()->can('import', Asset::class);
	}

	public function rules()
	{
		return [
			'asset' => ['required', 'file', 'image']
		];
	}
}
