<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PostTest extends TestCase
{
    public function testCreatePost()
    {
        $post = Post::factory()->make();
        $user = User::factory()->create();

        $response = $this->JWTActingAs($user)->postJson('/api/posts/create', [
            'title' => $post->title,
            'body'  => $post->body,
            'tags'  => ['test', 'tag']
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'title',
                     'body',
                     'owner',
                     'main_image',
                     'tags'
                 ]);
    }

    public function testUpdatePost()
    {
        $post = Post::factory()->create();
        $user = User::find($post->user_id);

        $response = $this->JWTActingAs($user)->postJson('/api/posts/update/' . $post->id, [
            'title' => 'Test'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'title',
                     'body',
                     'owner',
                     'main_image',
                     'tags'
                 ])->assertJson(fn(AssertableJson $json) => $json->where('title', 'Test')->etc());
    }

    public function testUpdateTagsOnPost()
    {
        $this->markTestIncomplete();
    }

    public function testFailedUpdateForWrongUser()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $response = $this->JWTActingAs($user)->postJson('/api/posts/update/' . $post->id, [
            'title' => 'Test'
        ]);

        $response->assertStatus(403);
    }

    public function testDeletePost()
    {
        $post = Post::factory()->create();
        $user = User::find($post->user_id);

        $response = $this->JWTActingAs($user)->postJson('/api/posts/delete/' . $post->id);

        $response->assertStatus(200);
    }

    public function testFailedDeleteForWrongUser()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $response = $this->JWTActingAs($user)->postJson('/api/posts/delete/' . $post->id);

        $response->assertStatus(403);
    }

    public function testGetPost()
    {
        $post = Post::factory()->create();

        $response = $this->getJson('/api/posts/' . $post->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'title',
                     'body',
                     'owner',
                     'main_image',
                     'tags'
                 ]);
    }

    public function testGetAllPosts()
    {
        Post::factory()->count(3)->create();

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'title',
                         'body',
                         'owner',
                         'main_image',
                         'tags'
                     ]
                 ]);
    }
}
