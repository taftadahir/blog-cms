<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
			$table->foreignId('category_id')->nullable()->constrained('categories');
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
			$table->dropForeign(['category_id']);
        });
    }
};
