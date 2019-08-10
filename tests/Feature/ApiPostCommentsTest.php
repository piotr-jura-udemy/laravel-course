<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\BlogPost;
use App\Comment;

class ApiPostCommentsTest extends TestCase
{
    use RefreshDatabase;

    public function testNewBlogPostDoesNotHaveComments()
    {
        factory(BlogPost::class)->create([
            'user_id' => $this->user()->id
        ]);

        $response = $this->json('GET', 'api/v1/posts/1/comments');

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'links', 'meta'])
            ->assertJsonCount(0, 'data');
    }

    public function testBlogPostHas10Comments()
    {
        factory(BlogPost::class)->create([
            'user_id' => $this->user()->id
        ])->each(function (BlogPost $post) {
            $post->comments()->saveMany(
                factory(Comment::class, 10)->make([
                    'user_id' => $this->user()->id
                ])
            );
        });

        $response = $this->json('GET', 'api/v1/posts/2/comments');

        $response->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        '*' => [
                            'id',
                            'contnt',
                            'created_at',
                            'updated_at',
                            'user' => [
                                'id',
                                'name'
                            ]
                        ]
                    ],
                    'links',
                    'meta'
                ]
            )
            ->assertJsonCount(10, 'data');
    }
}
