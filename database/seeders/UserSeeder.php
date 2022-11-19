<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$subscriberRole = Role::where('code', 'subscriber')->first();
		if ($subscriberRole) {
			$subscriber = new User(
				[
					'name' => 'Subscriber',
					'email' => 'subscriber@blog.com',
					'password' => bcrypt('password'),
				]
			);
			$subscriber->role()->associate($subscriberRole);
			$subscriber->save();
		}

		$adminRole = Role::where('code', 'administrator')->first();
		if ($adminRole) {
			$admin = new User(
				[
					'name' => 'Admin',
					'email' => 'admin@blog.com',
					'password' => bcrypt('password'),
				],
			);
			$admin->role()->associate($adminRole);
			$admin->save();
		}
	}
}
