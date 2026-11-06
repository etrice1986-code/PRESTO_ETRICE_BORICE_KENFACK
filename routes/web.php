<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\MessageController;





Route::get('/', [PublicController::class, 'homepage'])->name('home');

Route::get('/lavora-con-noi', [RevisorController::class, 'careers'])->name('careers')->middleware('auth');

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

Route::middleware(['auth'])->group(function () {

    Route::get('/i-miei-annunci', [ArticleController::class, 'myArticles'])
        ->name('article.my');

    Route::get('/annuncio/{article}/modifica', [ArticleController::class, 'edit'])
        ->name('article.edit');

    Route::put('/annuncio/{article}', [ArticleController::class, 'update'])
        ->name('article.update');

    Route::delete('/annuncio/{article}', [ArticleController::class, 'destroy'])
        ->name('article.destroy');
});


Route::get('/chi-siamo', [ArticleController::class, 'aboutUs'])->name('about.us');


Route::get('/contattaci', [ArticleController::class, 'contact'])->name('contact.us')->middleware('auth');
Route::post('/contattaci/invia', [ArticleController::class, 'contactSubmit'])->name('contact.submit');




Route::post('/article/{article}/contact', [MessageController::class, 'store'])
    ->name('messages.store')
    ->middleware('auth');





Route::get('/messaggi', [MessageController::class, 'index'])->name('messages.index')->middleware('auth');


Route::post('/messaggi/{message}/reply', [MessageController::class, 'reply'])->name('messages.reply')->middleware('auth');


Route::post('/messages/read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead')->middleware('auth');


// Esempio sulla tua rotta che promuove l'utente a revisore
Route::post('/utente/{user}/rendi-revisore', [PublicController::class, 'makeRevisor'])
    ->name('make.revisor')
    ->middleware('auth');


// Rotta per vedere la lista di tutti i revisori
Route::get('/amministratore/revisori', [RevisorController::class, 'revisorsList'])
    ->name('revisor.list')
    ->middleware('auth');

// Rotta per rimuovere la carica di revisore a un utente
Route::post('/amministratore/rimuovi-revisore/{user}', [RevisorController::class, 'removeRevisor'])
    ->name('revisor.remove')
    ->middleware('auth');
