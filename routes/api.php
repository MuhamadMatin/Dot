<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.api.index');
    Route::post('/users', [UserController::class, 'store'])
        ->name('users.api.store');
    Route::get('/users/{users}', [UserController::class, 'show'])
        ->name('users.api.show');
    Route::put('/users/{users}', [UserController::class, 'update'])
        ->name('users.api.update');
    Route::delete('/users/{users}', [UserController::class, 'destroy'])
        ->name('users.api.delete');


    Route::get('/posts', [PostController::class, 'index'])
        ->name('posts.api.index');
    Route::post('/posts', [PostController::class, 'store'])
        ->name('posts.api.store');
    Route::get('/posts/{post}', [PostController::class, 'show'])
        ->name('posts.api.show');
    Route::put('/posts/{post}', [PostController::class, 'update'])
        ->name('posts.api.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])
        ->name('posts.api.delete');


    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('api.logout');
});

Route::post('/register', [AuthController::class, 'register'])
    ->name('api.register');
Route::post('/login', [AuthController::class, 'login'])
    ->name('api.login');
