<?php

namespace App\Http\Controllers;

use App\Mail\CareerRequestMail;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class RevisorController extends Controller
{

    public function index()
    {

        $articleToReview = Article::where('is_accepted', null)->first();


        $lastEditedArticle = session('lastEditedArticle');

        return view('revisor.index', compact('articleToReview', 'lastEditedArticle'));
    }


    public function acceptArticle(Article $article)
    {
        $article->update(['is_accepted' => true]);

        session()->put('lastEditedArticle', $article->id);

        return redirect()->back()->with('message', 'Articolo accettato correttamente.');
    }


    public function rejectArticle(Article $article)
    {
        $article->update(['is_accepted' => false]);

        session()->put('lastEditedArticle', $article->id);

        return redirect()->back()->with('message', 'Articolo rifiutato correttamente.');
    }


    public function undoLastAction()
    {
        $articleId = session('lastEditedArticle');

        if ($articleId) {
            $article = Article::find($articleId);
            $article->update(['is_accepted' => null]);

            session()->forget('lastEditedArticle');

            return redirect()->back()->with('message', 'Ultima azione annullata.');
        }

        return redirect()->back();
    }





    public function careers()
    {
        return view('careers');
    }



    public function careersSubmit(Request $request)
    {
        $request->validate([
            'message' => 'required|min:20',
        ], [
            'required' => 'Il messaggio di presentazione è obbligatorio.',
            'min' => 'Il messaggio deve contenere almeno 20 caratteri.',
        ]);

        $user = Auth::user();
        $messageText = $request->input('message');

        Mail::to('admin@presto.it')->send(new CareerRequestMail($user, $messageText));

        return redirect()->route('home')
            ->with('message', 'La tua richiesta è stata inviata con successo! Verrai ricontattato via email.');
    }


    public function makeRevisor(User $user)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();


        abort_if(
            !$currentUser || !$currentUser->isSuperAdmin(),
            403,
            'Operazione non consentita. Solo il Super-Amministratore può nominare nuovi revisori.'
        );


        Artisan::call(
            'presto:make-user-revisor',
            ['email' => $user->email]
        );

        return redirect()->route('home')
            ->with('message', "Complimenti! L'utente {$user->name} è ora revisore.");
    }



    /**
     * Mostra la lista di tutti i revisori attivi (Solo per il Super-Admin)
     */
    public function revisorsList()
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        // Protezione di sicurezza a livello di backend
        abort_if(
            !$currentUser || !$currentUser->isSuperAdmin(),
            403,
            'Accesso negato. Solo il Super-Amministratore può consultare questa lista.'
        );

        // Recupera tutti gli utenti che hanno la spunta is_revisor attiva
        $revisors = User::where('is_revisor', true)->get();

        return view('revisor.list', compact('revisors'));
    }

    /**
     * Rimuove la carica di revisore a un utente specifico
     */
    public function removeRevisor(User $user)
    {
        /** @var \App\Models\User $currentUser */
        $currentUser = Auth::user();

        // Impedisci l'azione a chi non è l'admin principale
        abort_if(
            !$currentUser || !$currentUser->isSuperAdmin(),
            403,
            'Operazione non consentita.'
        );

        // Impedisci all'admin di togliersi la carica da solo per errore
        if ($user->id === $currentUser->id) {
            return redirect()->back()->with('error', 'Non puoi revocare la carica a te stesso!');
        }

        // Portiamo la colonna a false nel database
        $user->update(['is_revisor' => false]);

        return redirect()->back()->with('message', "Privilegi revocati con successo a {$user->name}.");
    }
}
