<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(Request $request){}
    public function show(Request $request, File $file){}
    public function create(Request $request){}
    public function update(Request $request, File $file){}
}
