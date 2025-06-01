<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaptopController;

// Route::get('/', function () {
//     return view('user.index');
// });

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Halaman user.index bisa diakses tanpa login
Route::get('/', [UserController::class, 'index'])->name('user');

// Route ke halaman about
Route::view('/about', 'about')->name('about');

Route::get('/laptop/{laptop}', [UserController::class, 'show'])->name('laptop.show');
Route::resource('laptop', LaptopController::class);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        if (Auth::User()->role === 'admin') {
            return view('admin.index');
        }
        // Jika user, redirect ke homepage user
        return redirect()->route('user');
    })->name('admin');

    Route::get('/wishlist', [UserController::class, 'wishlist'])->name('wishlist.index');
    Route::post('/wishlist/{laptop}', [UserController::class, 'addWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/{laptop}', [UserController::class, 'removeWishlist'])->name('wishlist.remove');

});

