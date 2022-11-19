<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class PermissionRoleSeeder extends Seeder
{
	public function run()
	{
		if (App::environment('local')) {
			DB::table('permission_role')->insert([
				'role_id' => 1,
				'permission_id' => 1,
				'created_at' => now(),
				'updated_at' => now()
			]);
		}
	}
}
