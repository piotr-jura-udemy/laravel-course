<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $doe = factory(App\User::class)->states('john-doe')->create();
        $else = factory(App\User::class, 20)->create();

        $users = $else->concat([$doe]);

        $posts = factory(App\BlogPost::class, 50)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });

        $comments = factory(App\Comment::class, 150)->make()->each(function ($comment) use ($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
