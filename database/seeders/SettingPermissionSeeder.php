<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class SettingPermissionSeeder extends Seeder
{
	public function run()
	{
		# permissions
		$create = Permission::create([
			'title' => 'Create setting',
			'code' => 'create-setting',
		]);
		$viewAny = Permission::create([
			'title' => 'View any setting',
			'code' => 'view-any-setting',
		]);
		$update = Permission::create([
			'title' => 'Update setting',
			'code' => 'update-setting',
		]);
		$delete = Permission::create([
			'title' => 'Delete setting',
			'code' => 'delete-setting',
		]);

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
			$permissionRole->permission()->associate($update);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($delete);
			$permissionRole->save();
		}
	}
}
