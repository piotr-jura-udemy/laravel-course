<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class ChangeBlogpostsTableName extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::rename('blogposts', 'blog_posts');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::rename('blog_posts', 'blogposts');
    }
}
