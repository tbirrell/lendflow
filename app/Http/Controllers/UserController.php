<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request)
    {
        return UserResource::collection(User::all());
    }

    public function show(Request $request, User $user)
    {
        return new UserResource($user);
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => $data['password'],
        ]);

        return [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'token' => $this->createToken($user)
        ];
    }

    public function update(Request $request, User $user)
    {
        $data = $request->all();

        $user->update($data);

        return [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
            'token' => $this->createToken($user)
        ];
    }

    protected function createToken($user)
    {
        return [
            'access_token' => auth('api')->login($user),
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60
        ];
    }
}
