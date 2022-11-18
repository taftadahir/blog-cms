<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    use HasFactory, SoftDeletes;
	protected $table = 'role_user';

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id');
	}
}
