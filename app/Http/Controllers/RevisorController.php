<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

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


    public function makeRevisor(User $user)
    {
        $user->update(['is_revisor' => true]);

        return redirect()->route('home')
            ->with('message', "Complimenti! L'utente {$user->name} è ora revisore.");
    }
}
