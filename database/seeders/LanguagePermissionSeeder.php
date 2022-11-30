<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class LanguagePermissionSeeder extends Seeder
{
	public function run()
	{
		# permissions
		$create = Permission::create([
			'title' => 'Create language',
			'code' => 'create-language',
		]);
		$viewAny = Permission::create([
			'title' => 'View any language',
			'code' => 'view-any-language',
		]);
		$update = Permission::create([
			'title' => 'Update language',
			'code' => 'update-language',
		]);
		$delete = Permission::create([
			'title' => 'Delete language',
			'code' => 'delete-language',
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
