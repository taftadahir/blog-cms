<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('tags', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug')->unique();
			$table->string('description')->nullable();
			$table->boolean('published')->default(false);
			$table->timestamp('published_at')->nullable();
			$table->foreignId('published_by')->nullable()->constrained('users');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::dropIfExists('tags');
	}
};
