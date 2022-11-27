<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('article_id')->constrained('articles');
			$table->foreignId('parent_id')->nullable()->constrained('comments');
			$table->foreignId('user_id')->nullable()->constrained('users');
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->longText('content');
			$table->string('status')->default('default');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::dropIfExists('comments');
	}
};
