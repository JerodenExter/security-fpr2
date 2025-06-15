<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\RegisterController;

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

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

// Login verwerking
Route::post('/login', [LoginController::class, 'store'])->name('login.store');

// Logout
Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');
