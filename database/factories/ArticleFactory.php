<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
	public function definition()
	{
		$user = User::inRandomOrder()->first();
		return [
			'sys_id' => 'PREFIX00' . substr(string: fake()->unique()->slug(8), length: 16, offset: 0),
			'created_by' => $user->id,

			'title' => fake()->text(100),
			'slug' => fake()->unique()->slug(5),

			'content' => fake()->sentence(250),
			'excerpt' => fake()->sentence(25),

			'read_time' => fake()->numberBetween(0, 255),
			'view_count' => fake()->numberBetween(0, 500000)
		];
	}
}
