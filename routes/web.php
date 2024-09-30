<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
// Rutas Publicas
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
// Rutas de Privadas
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index'); // Ruta para mostrar los posts
    Route::post('/post', [PostController::class, 'store'])->name('posts.store'); // Ruta para crear un post
    Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show'); // Ruta para mostrar un post
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update'); // Ruta para actualizar un post
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.delete'); // Ruta para eliminar un post

    Route::post('/image/upload', [PostController::class, 'uploadImage'])->name('image.upload'); // Ruta para subir las imagenes
});

