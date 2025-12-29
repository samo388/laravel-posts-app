<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية
Route::get('/', function () {
    return view('welcome');
});

// Routes بتاعة Auth (Login / Register / Logout)
require __DIR__.'/auth.php';

// Routes محمية (لازم Login)
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile (جاية مع Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Posts CRUD
    Route::resource('posts', PostController::class);
});
