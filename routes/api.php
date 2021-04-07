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

Route::get('file/get_all', [FileController::class, 'index']);
Route::get('file/{file}', [FileController::class, 'show']);
Route::post('file/create', [FileController::class, 'create']); //auth me
Route::post('file/update/{file}', [FileController::class, 'update']); //auth me lock to owner

Route::post('tag/create', [TagController::class, 'index']); //auth me
Route::post('tag/update/{tag}', [TagController::class, 'show']); //auth me lock to owner
Route::post('tag/delete/{tag}', [TagController::class, 'delete']); //auth me lock to owner
Route::get('tag/get_all', [TagController::class, 'create']);
Route::get('tag/{tag}', [TagController::class, 'update']);

Route::get('post/get_all', [PostController::class, 'index']);
Route::get('post/{post}', [PostController::class, 'show']);
Route::post('post/create', [PostController::class, 'create']); //auth me
Route::post('post/update/{post}', [PostController::class, 'update']); //auth me lock to owner
Route::post('post/delete/{post}', [PostController::class, 'delete']); //auth me lock to owner

