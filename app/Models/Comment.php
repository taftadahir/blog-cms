<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'name',
		'email',
		'content',
	];

	public function article()
	{
		return $this->belongsTo(Article::class, 'article_id');
	}

	public function parent()
	{
		return $this->belongsTo(Comment::class, 'parent_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
}
