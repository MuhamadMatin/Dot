<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index');
    Route::get('/user/create', [UserController::class, 'create'])
        ->name('user.create');
    Route::post('/user/create/store', [UserController::class, 'store'])
        ->name('user.store');
    Route::get('/user/{user}', [UserController::class, 'show'])
        ->name('user.show');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])
        ->name('user.edit');
    Route::put('/user/{user}/update', [UserController::class, 'update'])
        ->name('user.update');
    Route::delete('/user/{user}/delete', [UserController::class, 'destroy'])
        ->name('user.delete');


    Route::get('/posts', [PostController::class, 'index'])
        ->name('posts.index');
    Route::get('/post/create', [PostController::class, 'create'])
        ->name('post.create');
    Route::post('/post/create/store', [PostController::class, 'store'])
        ->name('post.store');
    Route::get('/post/{post:slug}', [PostController::class, 'show'])
        ->name('post.show');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])
        ->name('post.edit');
    Route::put('/post/{post}/update', [PostController::class, 'update'])
        ->name('post.update');
    Route::delete('/post/{post}/delete', [PostController::class, 'destroy'])
        ->name('post.delete');


    Route::get('/signout', [AuthController::class, 'signOut'])
        ->name('signout');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/store', [AuthController::class, 'loginStore'])->name('login.store');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register/store', [AuthController::class, 'registerStore'])->name('register.store');
