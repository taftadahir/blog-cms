<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class CommentPermissionSeeder extends Seeder
{
	public function run()
	{
		# permissions
		$create = Permission::create([
			'title' => 'Create comment',
			'code' => 'create-comment',
		]);
		$viewAny = Permission::create([
			'title' => 'View any comment',
			'code' => 'view-any-comment',
		]);
		$updateAny = Permission::create([
			'title' => 'Update comment any',
			'code' => 'update-comment-any',
		]);
		$deleteAny = Permission::create([
			'title' => 'Delete comment any',
			'code' => 'delete-comment-any',
		]);

		# permissions role
		$subscriberRole = Role::where('code', 'subscriber')->first();
		if ($subscriberRole) {
			$permissionRole = new PermissionRole();

			$permissionRole->role()->associate($subscriberRole);
			$permissionRole->permission()->associate($create);
			$permissionRole->save();
		}

		# permissions role
		$adminRole = Role::where('code', 'administrator')->first();
		if ($adminRole) {
			$permissionRole = new PermissionRole();

			$permissionRole->role()->associate($adminRole);
			$permissionRole->permission()->associate($create);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($viewAny);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($updateAny);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($deleteAny);
			$permissionRole->save();
		}
	}
}
