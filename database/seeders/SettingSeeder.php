<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
	public function run()
	{
		# global setting
		$subscriberRole = Role::where('code', 'subscriber')->first();

		if ($subscriberRole) {
			Setting::create([
				'code' => 'default_user_role',
				'value' => $subscriberRole->id,
				'description' => 'Default role given to newly registered user'
			]);
		}

		Setting::create([
			'code' => 'enable_registration',
			'value' => 'true',
			'description' => 'Enable registration'
		]);

		Setting::create([
			'code' => 'app_name',
			'value' => 'Andal',
			'description' => 'Application name'
		]);

		Setting::create([
			'code' => 'disable_softdelete',
			'value' => 'false',
			'description' => 'Disable softdelete'
		]);

		Setting::create([
			'code' => 'disable_comment',
			'value' => 'false',
			'description' => 'Disable comment'
		]);

		Setting::create([
			'code' => 'disable_guest_comment',
			'value' => 'true',
			'description' => 'Disable guest comment'
		]);

		Setting::create([
			'code' => 'default_comment_status',
			'value' => 'default',
			'description' => 'Default comment status [ default, approved, disapproved ]'
		]);
	}
}
