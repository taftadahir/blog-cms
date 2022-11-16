<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		if (App::environment('local')) {
			$this->call([
				UserSeeder::class
			]);
		}
	}
}
