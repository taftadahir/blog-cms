<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->boolean('active')->default(true);
			$table->string('email')->unique();
			$table->string('name');
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->timestamp('email_verified_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::dropIfExists('users');
	}
};
