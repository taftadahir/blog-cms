<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
	public function run()
	{
		# permissions
		$addPermToRole = Permission::create([
			'title' => 'Add permission to role',
			'code' => 'add-permission-to-role',
		]);
		$removePermFromRole = Permission::create([
			'title' => 'Remove permission from role',
			'code' => 'remove-permission-from-role',
		]);
		$create = Permission::create([
			'title' => 'Create role',
			'code' => 'create-role',
		]);
		$viewAny = Permission::create([
			'title' => 'View any role',
			'code' => 'view-any-role',
		]);
		$update = Permission::create([
			'title' => 'Update role',
			'code' => 'update-role',
		]);
		$delete = Permission::create([
			'title' => 'Delete role',
			'code' => 'delete-role',
		]);

		# permissions role
		$adminRole = Role::where('code', 'administrator')->first();
		if ($adminRole) {
			$permissionRole = new PermissionRole();

			$permissionRole->role()->associate($adminRole);
			$permissionRole->permission()->associate($addPermToRole);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($removePermFromRole);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($create);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($viewAny);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($update);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($delete);
			$permissionRole->save();
		}
	}
}
