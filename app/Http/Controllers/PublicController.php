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
