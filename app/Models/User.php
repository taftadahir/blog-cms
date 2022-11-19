<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

	protected $fillable = [
		'name',
		'first_name',
		'last_name',
		'email',
		'password',
	];

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	protected function active(): Attribute
	{
		return Attribute::make(
			get: fn ($value) => $value == 1,
		);
	}

	public function createdArticles()
	{
		return $this->hasMany(Article::class, 'created_by');
	}

	public function role()
	{
		return $this->belongsTo(Role::class, 'role_id');
	}
}
