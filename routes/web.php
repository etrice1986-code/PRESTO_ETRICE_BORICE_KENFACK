<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;


Route::get('/', [PublicController::class, 'homepage'])->name('home');




Route::middleware(['auth'])->group(function () {
    Route::get('/annuncio/nuovo', [ArticleController::class, 'create'])->name('article.create');
});



Route::get('/annunci', [ArticleController::class, 'index'])->name('article.index');


Route::get('/annuncio/dettaglio/{article}', [ArticleController::class, 'show'])->name('article.show');


Route::get('/categoria/{category}', [PublicController::class, 'categoryShow'])->name('category.show');
