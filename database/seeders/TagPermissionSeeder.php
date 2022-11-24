<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class TagPermissionSeeder extends Seeder
{
	public function run()
	{
		# permissions
		$create = Permission::create([
			'title' => 'Create tag',
			'code' => 'create-tag',
		]);
		$viewAny = Permission::create([
			'title' => 'View any tag',
			'code' => 'view-any-tag',
		]);
		$update = Permission::create([
			'title' => 'Update tag',
			'code' => 'update-tag',
		]);
		$delete = Permission::create([
			'title' => 'Delete tag',
			'code' => 'delete-tag',
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
