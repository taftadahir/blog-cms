<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
	public function run()
	{
		$adminUser = User::where('email', 'admin@blog.com')->first();
		$subscriberUser = User::where('email', 'subscriber@blog.com')->first();

		$adminRole = Role::where('code', 'administrator')->first();
		$subscriberRole = Role::where('code', 'subscriber')->first();

		if ($adminUser && $adminRole) {
			DB::table('role_user')->insert([
				'role_id' => $adminRole->id,
				'user_id' => $adminUser->id,
				'created_at' => now(),
				'updated_at' => now()
			]);
		}

		if ($subscriberUser && $subscriberRole) {
			DB::table('role_user')->insert([
				'role_id' => $subscriberRole->id,
				'user_id' => $subscriberUser->id,
				'created_at' => now(),
				'updated_at' => now()
			]);
		}
	}
}
