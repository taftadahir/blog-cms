<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('languages', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('iso_code')->unique();
			$table->boolean('active')->default(false);
			$table->timestamps();
			$table->softDeletes();
		});

		Schema::table('users', function (Blueprint $table) {
			$table->foreignId('language_id')->nullable()->constrained('languages');
		});

		Schema::table('articles', function (Blueprint $table) {
			$table->foreignId('language_id')->nullable()->constrained('languages');
		});
	}

	public function down()
	{
		Schema::dropIfExists('languages');

		Schema::table('users', function ($table) {
			$table->dropForeign(['language_id']);
		});

		Schema::table('articles', function ($table) {
			$table->dropForeign(['language_id']);
		});
	}
};
