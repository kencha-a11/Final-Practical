<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

// Homepage route (login page)
Route::get('/', function () {
    return view('auth.login');
});

// Authentication routes for guest users (register and login)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register/post', [AuthController::class, 'registerForm'])->name('registerForm');

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login/post', [AuthController::class, 'loginForm'])->name('loginForm');
});

// Authenticated routes (dashboard, posts management)
Route::middleware('auth')->group(function (){
    // Dashboard route
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout/post', [AuthController::class, 'logout'])->name('logoutForm');

    // Posts routes
    Route::get('/posts/index', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/show/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/destroy/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});
