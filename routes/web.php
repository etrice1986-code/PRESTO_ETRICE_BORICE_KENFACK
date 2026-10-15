<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RevisorController;



Route::get('/', [PublicController::class, 'homepage'])->name('home');




Route::middleware(['auth'])->group(function () {
    Route::get('/annuncio/nuovo', [ArticleController::class, 'create'])->name('article.create');
});



Route::get('/annunci', [ArticleController::class, 'index'])->name('article.index');


Route::get('/annuncio/dettaglio/{article}', [ArticleController::class, 'show'])->name('article.show');


Route::get('/categoria/{category}', [PublicController::class, 'categoryShow'])->name('category.show');



Route::middleware(['auth'])->group(function () {
    Route::get('/revisore/dashboard', [RevisorController::class, 'index'])->name('revisor.index');
});




Route::middleware(['auth', 'isRevisor'])->group(function () {
    Route::get('/revisore/dashboard', [RevisorController::class, 'index'])->name('revisor.index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/lavora-con-noi', [PublicController::class, 'careers'])->name('careers');
    Route::post('/lavora-con-noi/submit', [PublicController::class, 'careersSubmit'])->name('careers.submit');
});



Route::get('/lingua/{locale}', [PublicController::class, 'setLocale'])->name('setLocale');
