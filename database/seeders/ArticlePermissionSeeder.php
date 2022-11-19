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
		$view = Permission::create([
			'title' => 'View article',
			'code' => 'view-article',
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
			$permissionRole->permission()->associate($view);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($update);
			$permissionRole->save();

			$permissionRole = $permissionRole->replicate();
			$permissionRole->permission()->associate($delete);
			$permissionRole->save();
		}

		$subscriberRole = Role::where('code', 'subscriber')->first();
		if($subscriberRole){
			$permissionRole = new PermissionRole();

			$permissionRole->role()->associate($subscriberRole);
			$permissionRole->permission()->associate($view);
			$permissionRole->save();
		}
	}
}
