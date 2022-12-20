<?php

namespace App\Policies;

use App\Models\Language;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagePolicy
{
	use HandlesAuthorization;

	private function viewAny(?User $user)
	{
		if ($user) {
			return $user->hasPermission('view-any-language');
		}

		return false;
	}

	public function view(User $user, Language $language)
	{
		if ($this->viewAny($user)) {
			return true;
		}

		# dd($language);
		return $language->active;
	}

	public function create(User $user)
	{
		return $user->hasPermission('create-language');
	}

	public function update(User $user)
	{
		return $user->hasPermission('update-language');
	}

	public function delete(User $user)
	{
		return $user->hasPermission('delete-language');
	}

	public function restore(User $user, Language $language)
	{
	}

	public function forceDelete(User $user, Language $language)
	{
	}
}
