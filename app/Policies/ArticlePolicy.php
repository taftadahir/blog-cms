<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\ArticleStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
	use HandlesAuthorization;

	private function viewAny(?User $user)
	{
		if ($user) {
			return $user->hasPermission('view-any-article');
		}
		return false;
	}

	public function view(?User $user, Article $article)
	{
		if ($this->viewAny($user)) {
			return true;
		}

		return in_array($article->status, [
			ArticleStatus::PUBLISHED,
			ArticleStatus::OUTDATED,
			ArticleStatus::ARCHIVED
		]);
	}

	public function create(User $user)
	{
		return $user->hasPermission('create-article');
	}

	public function update(User $user)
	{
		return $user->hasPermission('update-article');
	}

	public function delete(User $user)
	{
		return $user->hasPermission('delete-article');
	}
}
