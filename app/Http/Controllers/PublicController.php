<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareerRequestMail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class PublicController extends Controller
{
    public function homepage()
    {

        $articles = Article::with('category')
            ->where('is_accepted', true)
            ->latest()
            ->take(6)
            ->get();

        return view('welcome', compact('articles'));
    }

    public function index()
    {

        $articles = Article::with('category')
            ->where('is_accepted', true)
            ->latest()
            ->paginate(12);

        return view('article.index', compact('articles'));
    }

    public function show(Article $article)
    {

        return view('article.show', compact('article'));
    }

    public function categoryShow(Category $category)
    {

        $articles = $category->articles()
            ->where('is_accepted', true)
            ->latest()
            ->get();

        return view('category.show', compact('category', 'articles'));
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


        return redirect()->route('home')->with('message', 'La tua richiesta è stata inviata con successo! Verrai ricontattato via email.');
    }



    public function setLocale($locale)
    {

        if (in_array($locale, ['it', 'en', 'es'])) {
            session()->put('locale', $locale);
        }

        return redirect()->back();
    }




    public function makeRevisor(User $user)
    {

        $user->is_revisor = true;
        $user->save();


        return redirect()->route('home')->with('message', "Complimenti! L'utente {$user->name} è diventato ufficialmente un revisore.");
    }
}
