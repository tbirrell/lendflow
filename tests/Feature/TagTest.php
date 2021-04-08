<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function testCreateTag()
    {
        $tag = Tag::factory()->make();
        $user = User::factory()->create();

        $response = $this->JWTActingAs($user)->postJson('/api/tags/create', [
            'name' => $tag->name
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'id',
                     'name'
                 ]);
    }

    public function testUpdateTag()
    {
        $tag = Tag::factory()->create();
        $user = User::factory()->create();

        $response = $this->JWTActingAs($user)->postJson('/api/tags/update/' . $tag->id, [
            'name' => 'Test'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id',
                     'name'
                 ])->assertJson(fn(AssertableJson $json) => $json->where('name', 'Test')->etc());;
    }

    public function testFailedUpdateForWrongUser()
    {
        $this->markTestIncomplete();
    }

    public function testDeleteTag()
    {
        $tag = Tag::factory()->create();
        $user = User::factory()->create();

        $response = $this->JWTActingAs($user)->postJson('/api/tags/delete/' . $tag->id);

        $response->assertStatus(200);
    }

    public function testFailedDeleteForWrongUser()
    {
        $this->markTestIncomplete();
    }

    public function testGetTag()
    {
        $tag = Tag::factory()->create();

        $response = $this->getJson('/api/tags/' . $tag->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id',
                     'name'
                 ]);
    }

    public function testGetAllTags()
    {
        Tag::factory()->count(3)->create();

        $response = $this->getJson('/api/tags');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'name'
                     ]
                 ]);
    }
}
