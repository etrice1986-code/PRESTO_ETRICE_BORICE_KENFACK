<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'home'])->name('home');




Route::middleware(['auth'])->group(function () {
    Route::get('/annuncio/nuovo', [ArticleController::class, 'create'])->name('article.create');
});
