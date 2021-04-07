<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return Post::all();
    }

    public function show(Request $request, Post $post)
    {
        return $post;
    }

    public function create(Request $request)
    {
    }

    public function update(Request $request, Post $post)
    {
    }

    public function delete(Request $request, Post $post)
    {
    }
}
