<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		User::create(
			[
				'name' => 'Subscriber',
				'email' => 'subscriber@blog.com',
				'password' => bcrypt('password'),
			]
		);

		User::create(
			[
				'name' => 'Admin',
				'email' => 'admin@blog.com',
				'password' => bcrypt('password'),
			],
		);
	}
}
