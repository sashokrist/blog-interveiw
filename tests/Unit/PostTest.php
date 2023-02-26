<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
// my codes here
    }

    /**
     * A basic unit test example.
     */
    public function test_it_shows_a_given_post()
    {
        $post = Post::factory()->create();

        $this
            ->get(route('posts.show', $post))
            ->assertOk();
    }
}
