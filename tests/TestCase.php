<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\User;
use App\BlogPost;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function user()
    {
        return factory(User::class)->create();
    }

    protected function blogPost()
    {
        return factory(BlogPost::class)->create([
            'user_id' => $this->user()->id
        ]);
    }
}
