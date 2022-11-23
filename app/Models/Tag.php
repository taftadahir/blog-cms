<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'title',
		'slug',
		'description',
		'published',
		'published_at',
	];

	public function publishedBy()
	{
		return $this->belongsTo(User::class, 'published_by');
	}
}
