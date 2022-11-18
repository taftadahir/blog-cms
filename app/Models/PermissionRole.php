<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionRole extends Model
{
    use HasFactory, SoftDeletes;

	protected $table = 'permission_role';

	public function permission()
	{
		return $this->belongsTo(Permission::class, 'permission_id');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id');
	}
}
