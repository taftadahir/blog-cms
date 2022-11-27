<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'sys_id',
		'title',
		'slug',

		'content',
		'content_type',
		'excerpt',
		'keywords',

		'status',
		'disable_comment',
		'disable_approval',
		'read_time',
		'password',
		'version',

		'published_at',
		'archived_at',
		'updated_at',
		'outdated_at',
		'deleted_at'
	];

	protected $hidden = [];

	public function parent()
	{
		return $this->belongsTo(Article::class, 'parent_id');
	}

	public function createdBy()
	{
		return $this->belongsTo(User::class, 'created_by');
	}

	public function updatedBy()
	{
		return $this->belongsTo(User::class, 'updated_by');
	}

	public function publishedBy()
	{
		return $this->belongsTo(User::class, 'published_by');
	}

	public function archivedBy()
	{
		return $this->belongsTo(User::class, 'archived_by');
	}

	public function outdatedBy()
	{
		return $this->belongsTo(User::class, 'outdated_by');
	}

	public function deletedBy()
	{
		return $this->belongsTo(User::class, 'deleted_by');
	}

	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}
