<?php

namespace App\Http\Controllers;

use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        return TagResource::collection(Tag::all());
    }

    public function show(Request $request, Tag $tag)
    {
        return new TagResource($tag);
    }

    public function create(Request $request)
    {
        $data = $request->all();

        $tag = Tag::create($data);

        return new TagResource($tag);
    }

    public function update(Request $request, Tag $tag)
    {
        //todo only owner can update/delete his tags
        $data = $request->all();

        $tag->update($data);

        return new TagResource($tag);
    }

    public function delete(Request $request, Tag $tag)
    {
        //todo only owner can update/delete his tags
        $tag->delete();

        return 1;
    }
}
