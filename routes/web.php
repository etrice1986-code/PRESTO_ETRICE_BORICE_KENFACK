<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RevisorController;





Route::get('/', [PublicController::class, 'homepage'])->name('home');

Route::get('/lavora-con-noi', [RevisorController::class, 'careers'])->name('careers');
Route::post('/lavora-con-noi/submit', [RevisorController::class, 'careersSubmit'])->name('careers.submit');

Route::get('/lingua/{locale}', [PublicController::class, 'setLocale'])->name('setLocale');




Route::get('/annunci', [ArticleController::class, 'index'])->name('article.index');
Route::get('/annuncio/dettaglio/{article}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/categoria/{category}', [ArticleController::class, 'categoryShow'])->name('category.show');




Route::middleware(['auth'])->group(function () {
    Route::get('/annuncio/nuovo', [ArticleController::class, 'create'])->name('article.create');
});



Route::middleware(['auth', 'isRevisor'])->group(function () {

    Route::get('/revisore/dashboard', [RevisorController::class, 'index'])->name('revisor.index');

    Route::get('/revisore/{article}/accept', [RevisorController::class, 'acceptArticle'])->name('revisor.accept');
    Route::get('/revisore/{article}/reject', [RevisorController::class, 'rejectArticle'])->name('revisor.reject');
    Route::get('/revisore/undo', [RevisorController::class, 'undoLastAction'])->name('revisor.undo');
});

Route::get('/amministratore/rendi-revisore/{user}', [RevisorController::class, 'makeRevisor'])->name('make.revisor');
