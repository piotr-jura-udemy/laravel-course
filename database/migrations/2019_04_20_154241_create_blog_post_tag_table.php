<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogPostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_post_tag', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('blog_post_id')->index();
            $table->foreign('blog_post_id')->references('id')
                ->on('blog_posts')
                ->onDelete('cascade');

            $table->unsignedInteger('tag_id')->index();
            $table->foreign('tag_id')->references('id')
                ->on('tags')
                ->onDelete('cascade');    

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_post_tag');
    }
}
