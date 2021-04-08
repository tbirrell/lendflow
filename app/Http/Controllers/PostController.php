<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return PostResource::collection(Post::all());
    }

    public function show(Request $request, Post $post)
    {
        return new PostResource($post);
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $post = new Post();

        $post->title = $data['title'];
        $post->body = $data['body'];
        $post->user_id = auth('api')->user()->id;
        if (array_key_exists('main_image', $data)) {
            $post->main_image()->save($data['main_image']);
        }

        $post->save();

        $tags = [];
        foreach ($data['tags'] as $tag) {
            $t = Tag::orWhere('id', $tag)->orWhere('name', $tag)->first();
            if ($t === null) {
                $t = Tag::create(['name' => $tag]);
            }
            $tags[] = $t;
        }
        $post->tags()->saveMany($tags);

        return new PostResource($post);
    }

    public function update(Request $request, Post $post)
    {
        if (auth()->user()->id != $post->user_id) {
            return abort(403);
        }

        $data = $request->all();

        $post->update($data);

        return new PostResource($post);
    }

    public function delete(Request $request, Post $post)
    {
        if (auth()->user()->id != $post->user_id) {
            return abort(403);
        }

        $post->delete();

        return 1;
    }
}
