<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'title',
		'iso_code',
		'active',
	];

	protected $casts = [
		'active' => 'boolean',
	];

	public function uIMessages()
	{
		return $this->hasMany(UIMessage::class, 'language_id');
	}
}
