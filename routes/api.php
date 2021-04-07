<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('user/get_all', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('user/{user}', [\App\Http\Controllers\PostController::class, 'show']);
Route::post('user/create', [\App\Http\Controllers\PostController::class, 'create']);
Route::post('user/update/{user}', [\App\Http\Controllers\PostController::class, 'update']); //auth me

Route::get('file/get_all', [\App\Http\Controllers\FileController::class, 'index']);
Route::get('file/{file}', [\App\Http\Controllers\FileController::class, 'show']);
Route::post('file/create', [\App\Http\Controllers\FileController::class, 'create']); //auth me
Route::post('file/update/{file}', [\App\Http\Controllers\FileController::class, 'update']); //auth me lock to owner

Route::post('tag/create', [\App\Http\Controllers\TagController::class, 'index']); //auth me
Route::post('tag/update/{tag}', [\App\Http\Controllers\TagController::class, 'show']); //auth me lock to owner
Route::post('tag/delete/{tag}', [\App\Http\Controllers\TagController::class, 'delete']); //auth me lock to owner
Route::get('tag/get_all', [\App\Http\Controllers\TagController::class, 'create']);
Route::get('tag/{tag}', [\App\Http\Controllers\TagController::class, 'update']);

Route::get('post/get_all', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('post/{post}', [\App\Http\Controllers\PostController::class, 'show']);
Route::post('post/create', [\App\Http\Controllers\PostController::class, 'create']); //auth me
Route::post('post/update/{post}', [\App\Http\Controllers\PostController::class, 'update']); //auth me lock to owner
Route::post('post/delete/{post}', [\App\Http\Controllers\PostController::class, 'delete']); //auth me lock to owner

