<?php

namespace App\Policies;

use App\Models\Asset;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
{
	use HandlesAuthorization;

	public function viewAny(User $user)
	{
	}

	public function view(User $user, Asset $asset)
	{
	}

	public function import(User $user)
	{
		return $user->hasPermission('import-asset');
	}

	public function update(User $user)
	{
		return $user->hasPermission('update-asset');
	}

	public function delete(User $user)
	{
		return $user->hasPermission('delete-asset');
	}

	public function restore(User $user, Asset $asset)
	{
	}

	public function forceDelete(User $user, Asset $asset)
	{
	}
}
