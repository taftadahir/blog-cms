<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		# prod and dev envs
		$this->call([
			RoleSeeder::class,
		]);

		# dev env
		if (App::environment('local')) {
			$this->call([
				UserSeeder::class,
				ArticleSeeder::class
			]);
		}

		# prod and dev envs
		$this->call([
			ArticlePermissionSeeder::class,
			RolePermissionSeeder::class,
			AssetPermissionSeeder::class,
			TagPermissionSeeder::class,
		]);
	}
}
