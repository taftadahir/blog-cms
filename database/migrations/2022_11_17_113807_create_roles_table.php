<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('roles', function (Blueprint $table) {
			$table->id();

			$table->string('title');
			$table->string('code')->unique();
			$table->string('description')->nullable();

			$table->foreignId('created_by')->nullable()->constrained('users');
			$table->foreignId('updated_by')->nullable()->constrained('users');
			$table->foreignId('deleted_by')->nullable()->constrained('users');

			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::dropIfExists('roles');
	}
};
