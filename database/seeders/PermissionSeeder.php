<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
	public function run()
	{
		Permission::create([
			'title' => 'Create article',
			'code' => 'create-article',
			'description' => 'Create article'
		]);
	}
}
