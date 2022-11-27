<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
	public function run()
	{
		Language::create(
			[
				'title' => 'Français',
				'iso_code' => 'fra',
				'active' => true,
			]
		);

		Language::create(
			[
				'title' => 'English',
				'iso_code' => 'eng',
				'active' => true,
			]
		);
	}
}
