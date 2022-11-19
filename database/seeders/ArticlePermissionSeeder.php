<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Database\Seeder;

class ArticlePermissionSeeder extends Seeder
{
	public function run()
	{
		# permissions
		$create = Permission::create([
			'title' => 'Create article',
			'code' => 'create-article',
		]);
		$viewAny = Permission::create([
			'title' => 'View any article',
			'code' => 'view-any-article',
		]);
		$update = Permission::create([
			'title' => 'Update article',
			'code' => 'update-article',
		]);
		$delete = Permission::create([
			'title' => 'Delete article',
			'code' => 'delete-article',
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
