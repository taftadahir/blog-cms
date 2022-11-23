<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'code',
		'value',
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
