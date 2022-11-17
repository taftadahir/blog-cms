<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		# dev env
		if (App::environment('local')) {
			$this->call([
				UserSeeder::class,
				ArticleSeeder::class
			]);
		}
	}
}
