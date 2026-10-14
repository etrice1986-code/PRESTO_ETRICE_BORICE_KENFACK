<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index()
    {

        $articles = Article::with('category')
            ->where('is_accepted', true)
            ->latest()
            ->paginate(12);

        return view('article.index', compact('articles'));
    }


    public function create()
    {
        return view('article.create');
    }


    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }
}
