<?php

namespace App\Http\Controllers;

use App\Mail\CareerRequestMail;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
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
        $user->update(['is_revisor' => true]);

        return redirect()->route('home')
            ->with('message', "Complimenti! L'utente {$user->name} è ora revisore.");
    }
}
