<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;
use App\Models\Article;

// Register pagina
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Register verwerking met throttling
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('throttle:3,5')  // max 3 requests per 5 minuten
    ->name('register.store');

// Homepagina
Route::get('/', function () {
    $latestArticles = Article::orderBy('published_at', 'desc')->take(3)->get();
    return view('welcome', compact('latestArticles'));
})->name('home');

// Publieke routes
Route::resource('/articles', ArticleController::class);

// Routes alleen voor ingelogde gebruikers
Route::middleware(['auth'])->group(function () {
    Route::resource('/products', ProductController::class);
    Route::resource('/orders', ProductOrderController::class);
    Route::resource('/suppliers', SupplierController::class);
});

// Login formulier
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Login verwerking met throttling
Route::post('/login', [LoginController::class, 'store'])
    ->middleware('throttle:5,1')  // max 5 requests per minuut
    ->name('login.store');

// Logout
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

// Password reset routes
Route::controller(PasswordResetController::class)->group(function () {
    Route::get('/forgot-password', 'showLinkRequestForm')->name('password.request');
    Route::post('/forgot-password', 'sendResetLinkEmail')->name('password.email');
    Route::get('/reset-password/{token}', 'showResetForm')->name('password.reset');
    Route::post('/reset-password', 'reset')->name('password.update');
});
