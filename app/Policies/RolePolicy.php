<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
	use HandlesAuthorization;

	public function addPermissionToRole(User $user)
	{
		return $user->hasPermission('add-permission-to-role');
	}

	public function removePermissionFromRole(User $user)
	{
		return $user->hasPermission('remove-permission-from-role');
	}

	public function viewAny(User $user)
	{
		return $user->hasPermission('view-any-role');
	}

	public function create(User $user)
	{
		return $user->hasPermission('create-role');
	}

	public function update(User $user)
	{
		return $user->hasPermission('update-role');
	}

	public function delete(User $user)
	{
		return $user->hasPermission('delete-role');
	}
}
