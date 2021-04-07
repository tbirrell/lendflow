<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function testCreateUser()
    {
        $user = User::factory()->make();

        $response = $this->postJson('/api/users/create', [
            'name'     => $user->name,
            'email'    => $user->email,
            'password' => $user->password
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id',
                     'name',
                     'email',
                     'token' => [
                         'access_token',
                         'token_type',
                         'expires_in'
                     ],
                 ]);
    }

    public function testUpdateUser()
    {
        $user = User::factory()->create();

        $response = $this->JWTActingAs($user)->postJson('/api/users/update/' . $user->id, [
            'name' => 'Test Testerson',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id',
                     'name',
                     'email',
                     'token' => [
                         'access_token',
                         'token_type',
                         'expires_in'
                     ],
                 ])->assertJson(fn(AssertableJson $json) => $json->where('name', 'Test Testerson')->etc());
    }

    public function testGetUser()
    {
        $user = User::factory()->create();

        $response = $this->getJson('/api/users/' . $user->id);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'id',
                     'email',
                     'name',
                 ]);

    }

    public function testGetAllUsers()
    {

        $user = User::factory()->count(3)->create();

        $response = $this->getJson('/api/users/');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     '*' => [
                         'id',
                         'email',
                         'name',
                     ]
                 ]);

    }


}
