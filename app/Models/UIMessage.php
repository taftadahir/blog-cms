<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UIMessage extends Model
{
	protected $table = 'ui_messages';
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'code',
		'value',
		'description',
	];
}
