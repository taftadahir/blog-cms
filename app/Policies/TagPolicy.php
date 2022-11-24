<?php

namespace App\Policies;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TagPolicy
{
	use HandlesAuthorization;

	private function viewAny(?User $user)
	{
		if ($user) {
			return $user->hasPermission('view-any-tag');
		}

		return false;
	}

	public function view(?User $user, Tag $tag)
	{
		if ($this->viewAny($user)) {
			return true;
		}

		return $tag->published != 0;
	}

	public function create(User $user)
	{
		return $user->hasPermission('create-tag');
	}

	public function update(User $user)
	{
		return $user->hasPermission('update-tag');
	}

	public function delete(User $user)
	{
		return $user->hasPermission('delete-tag');
	}

	public function restore(User $user, Tag $tag)
	{
	}

	public function forceDelete(User $user, Tag $tag)
	{
	}
}
