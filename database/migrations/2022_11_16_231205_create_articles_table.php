<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up()
	{
		Schema::create('articles', function (Blueprint $table) {
			$table->id();
			$table->string('sys_id', 24);
			$table->foreignId('parent_id')->nullable()->constrained('articles');

			$table->string('title');
			$table->string('slug')->unique();

			$table->longText('content')->nullable();
			$table->string('content_type', 16)->default('html');
			$table->text('excerpt')->nullable();
			$table->string('keywords')->nullable();

			$table->string('status', 16)->default('draft');
			$table->boolean('disable_comment')->default(true);
			$table->string('default_comment_status')->default('default');
			$table->boolean('disable_approval')->default(true);
			$table->unsignedTinyInteger('read_time')->nullable();
			$table->unsignedInteger('view_count')->default(0);
			$table->string('password')->nullable();
			$table->unsignedTinyInteger('version')->default(0);

			$table->foreignId('created_by')->nullable()->constrained('users');
			$table->foreignId('updated_by')->nullable()->constrained('users')->after('created_by');
			$table->foreignId('published_by')->nullable()->constrained('users')->after('updated_by');
			$table->foreignId('archived_by')->nullable()->constrained('users')->after('published_by');
			$table->foreignId('outdated_by')->nullable()->constrained('users')->after('archived_by');
			$table->foreignId('deleted_by')->nullable()->constrained('users')->after('archived_by');

			$table->timestamps();
			$table->timestamp('published_at')->nullable();
			$table->timestamp('archived_at')->nullable();
			$table->timestamp('outdated_at')->nullable();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::dropIfExists('articles');
	}
};
