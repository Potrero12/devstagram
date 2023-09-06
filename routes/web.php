<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('principal');
});

// Auth - register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Auth - Login

// Muro
Route::get('/muro', [PostController::class, 'index'])->name('posts.index');

