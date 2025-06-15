<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Models\Article;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    // Take the 3 newest posts
    $latestArticles = Article::orderBy('published_at', 'desc')->take(3)->get();

    return view('welcome', compact('latestArticles'));
})->name('home');

// Resource routes of the base pages. For more info on Resource Routes
Route::resource('/articles', ArticleController::class);
// Routes die alleen toegankelijk zijn voor ingelogde gebruikers
Route::middleware(['auth'])->group(function () {
    Route::resource('/products', ProductController::class);
    Route::resource('/orders', ProductOrderController::class);
    Route::resource('/suppliers', SupplierController::class);
});
