<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'title',
		'code',
		'description',

		'created_at',
		'updated_at',
		'deleted_at'
	];

	public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}
	
	public function updatedBy()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by');
	}

	public function users()
    {
        return $this->belongsToMany(User::class);
    }

	public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
