<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleContentToBlogpostsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('blogposts', function (Blueprint $table) {
            $table->string('title')->default('');

            if (env('DB_CONNECTION') === 'sqlite_testing') {
                $table->text('content')->default('');
            } else {
                $table->text('content');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('blogposts', function (Blueprint $table) {
            $table->dropColumn(['title', 'content']);
        });
    }
}
