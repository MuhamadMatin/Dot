<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\IndexController;
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

Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])
        ->name('index');
    Route::resource('/users', UserController::class);
    Route::resource('/posts', PostController::class);


    Route::get('/signout', [AuthController::class, 'signOut'])
        ->name('signout');
});


Route::get('/login', [AuthController::class, 'login'])
    ->name('login');
Route::post('/login/store', [AuthController::class, 'loginStore'])
    ->name('login.store');
Route::get('/register', [AuthController::class, 'register'])
    ->name('register');
Route::post('/register/store', [AuthController::class, 'registerStore'])
    ->name('register.store');
