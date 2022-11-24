<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
	use HandlesAuthorization;

	private function viewAny(?User $user)
	{
		if ($user) {
			return $user->hasPermission('view-any-category');
		}

		return false;
	}

	public function view(?User $user, Category $category)
	{
		if ($this->viewAny($user)) {
			return true;
		}

		return $category->published != 0;
	}

	public function create(User $user)
	{
		return $user->hasPermission('create-category');
	}

	public function update(User $user)
	{
		return $user->hasPermission('update-category');
	}

	public function delete(User $user)
	{
		return $user->hasPermission('delete-category');
	}

	public function restore(User $user, Category $category)
	{
	}

	public function forceDelete(User $user, Category $category)
	{
	}
}
