<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareerRequestMail;

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


    public function setLocale($locale)
    {
        if (in_array($locale, ['it', 'en', 'es'])) {
            session()->put('locale', $locale);
        }

        $previous = url()->previous();

        if (str_contains($previous, '/lingua/')) {
            return redirect()->route('home');
        }

        return redirect($previous);
    }
}
