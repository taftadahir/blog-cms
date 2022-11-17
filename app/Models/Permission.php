<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'title',
		'code',
		'description',
	];

	protected $hidden = [];

	public function updatedBy()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by');
	}
}
