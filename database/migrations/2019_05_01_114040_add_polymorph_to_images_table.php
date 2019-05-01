<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPolymorphToImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn('blog_post_id');

            if (env('DB_CONNECTION') !== 'sqlite_testing') {
                $table->morphs('imageable');
            } else {
                $table->unsignedBigInteger('imageable_id')->default(0);
                $table->string('imageable_type')->default('');
            }    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->unsignedInteger('blog_post_id')->nullable();
            $table->dropMorphs('imageable');
        });
    }
}
