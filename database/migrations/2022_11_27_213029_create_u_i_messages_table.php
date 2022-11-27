<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('ui_messages', function (Blueprint $table) {
			$table->id();
			$table->foreignId('language_id')->constrained('languages');
			$table->string('code');
			$table->string('value')->nullable();
			$table->string('description')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::dropIfExists('ui_messages');
	}
};
