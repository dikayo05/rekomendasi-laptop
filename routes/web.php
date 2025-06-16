<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaptopController;

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Halaman user.index bisa diakses tanpa login
Route::get('/', [UserController::class, 'index'])->name('user');

// Route ke halaman about
Route::view('/about', 'about')->name('about');

// Hanya admin yang bisa akses create, edit, update, destroy laptop
Route::middleware('auth')->group(function () {
    Route::get('/laptop/create', function () {
        if (Auth::user()->role !== 'admin') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\LaptopController::class)->create();
    })->name('laptop.create');

    Route::post('/laptop', function (\Illuminate\Http\Request $request) {
        if (Auth::user()->role !== 'admin') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\LaptopController::class)->store($request);
    })->name('laptop.store');

    Route::get('/laptop/{laptop}/edit', function ($laptop) {
        if (Auth::user()->role !== 'admin') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\LaptopController::class)->edit($laptop);
    })->name('laptop.edit');

    Route::put('/laptop/{laptop}', function (\Illuminate\Http\Request $request, $laptop) {
        if (Auth::user()->role !== 'admin') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\LaptopController::class)->update($request, $laptop);
    })->name('laptop.update');

    Route::delete('/laptop/{laptop}', function ($laptop) {
        if (Auth::user()->role !== 'admin') abort(403, 'Unauthorized');
        return app(\App\Http\Controllers\LaptopController::class)->destroy($laptop);
    })->name('laptop.destroy');
});

// Route resource hanya untuk index & show (akses umum)
Route::resource('laptop', LaptopController::class)->only(['index', 'show']);

Route::get('/laptop/{laptop}', [UserController::class, 'show'])->name('laptop.show');

Route::middleware('auth')->group(function () {
    // Route::get('/dashboard', function () {
    //     if (Auth::User()->role === 'admin') {
    //         return view('admin.index');
    //     }
    //     // Jika user, redirect ke homepage user
    //     return redirect()->route('user');
    // })->name('admin');

    Route::get('/wishlist', [UserController::class, 'wishlist'])->name('wishlist.index');
    Route::post('/wishlist/{laptop}', [UserController::class, 'addWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/{laptop}', [UserController::class, 'removeWishlist'])->name('wishlist.remove');
});

// Route untuk fitur banding laptop (compare)
Route::post('/compare/add', [UserController::class, 'addToCompare'])->name('laptop.compare.add');
Route::post('/compare/remove', [UserController::class, 'removeFromCompare'])->name('laptop.compare.remove');
Route::post('/compare/reset', [UserController::class, 'resetCompare'])->name('laptop.compare.reset');
Route::get('/compare', [UserController::class, 'compare'])->name('laptop.compare');
Route::post('/compare', [UserController::class, 'compareShow'])->name('laptop.compare.show');
