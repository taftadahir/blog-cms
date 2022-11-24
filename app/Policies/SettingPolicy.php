<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
	use HandlesAuthorization;

	private function viewAny(User $user)
	{
		if ($user) {
			return $user->hasPermission('view-any-setting');
		}

		return false;
	}

	public function view(User $user, Setting $setting)
	{
		if ($this->viewAny($user)) {
			return true;
		}

		# user_id == null -> default for everybody
		return $setting->user_id == $user->id || $setting->user_id == null;
	}

	public function create(User $user)
	{
		return $user->hasPermission('create-setting');
	}

	public function update(User $user, Setting $setting)
	{
		return $user->hasPermission('update-setting') || $setting->user_id == $user->id;
	}

	public function delete(User $user, Setting $setting)
	{
		return $user->hasPermission('delete-setting') || $setting->user_id == $user->id;
	}

	public function restore(User $user, Setting $setting)
	{
	}

	public function forceDelete(User $user, Setting $setting)
	{
	}
}
