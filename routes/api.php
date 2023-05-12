<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::middleware('auth:sanctum')->group(function (){

    Route::apiResource('post',PostController::class);
    Route::controller(UserController::class)->group(function ()
    {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::put("/user", "update");
        Route::post("/user/picture", "uploadPicture");
        Route::get("/user/picture/{id}", "getPicture");
    });
    Route::apiResource('tags',TagController::class);
    Route::apiResource('comment',CommentController::class);

});

Route::get('/post', [PostController::class, 'index']);
