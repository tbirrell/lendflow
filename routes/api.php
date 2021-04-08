<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::get('users', [UserController::class, 'index']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::post('users/create', [UserController::class, 'create']);
Route::post('users/update/{user}', [UserController::class, 'update'])->middleware('auth:api'); //auth me

Route::get('files', [FileController::class, 'index']);
Route::get('files/{file}', [FileController::class, 'show']);
Route::post('files/create', [FileController::class, 'create'])->middleware('auth:api'); //auth me
Route::post('files/update/{file}', [FileController::class, 'update'])->middleware('auth:api'); //auth me lock to owner

Route::get('tags', [TagController::class, 'index']);
Route::get('tags/{tag}', [TagController::class, 'show']);
Route::post('tags/create', [TagController::class, 'create'])->middleware('auth:api'); //auth me
Route::post('tags/update/{tag}', [TagController::class, 'update'])->middleware('auth:api'); //auth me lock to owner
Route::post('tags/delete/{tag}', [TagController::class, 'delete'])->middleware('auth:api'); //auth me lock to owner

Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{post}', [PostController::class, 'show']);
Route::post('posts/create', [PostController::class, 'create'])->middleware('auth:api'); //auth me
Route::post('posts/update/{post}', [PostController::class, 'update'])->middleware('auth:api'); //auth me lock to owner
Route::post('posts/delete/{post}', [PostController::class, 'delete'])->middleware('auth:api'); //auth me lock to owner

