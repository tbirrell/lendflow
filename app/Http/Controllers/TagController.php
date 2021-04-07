<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index(Request $request){}
    public function show(Request $request, Tag $tag){}
    public function create(Request $request){}
    public function update(Request $request, Tag $tag){}
    public function delete(Request $request, Tag $tag){}
}
