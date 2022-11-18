<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
		Role::create([
			'title'=>'Administrator',
			'code'=>'administrator',
			'description'=>'Administrator have ability to do everything available on the platform.'
		]);

		Role::create([
			'title'=>'Subscriber',
			'code'=>'subscriber',
			'description'=>'Subscriber role. Ability will be define later.'
		]);

    }
}
