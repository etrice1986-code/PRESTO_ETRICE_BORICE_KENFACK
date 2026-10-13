<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function homepage()
    {

        $articles = Article::with('category')->latest()->take(6)->get();

        return view('welcome', compact('articles'));
    }



    public function index()
    {

        $articles = Article::with('category')->latest()->paginate(12);
        return view('article.index', compact('articles'));
    }

    public function show(Article $article)
    {

        return view('article.show', compact('article'));
    }


    public function categoryShow(Category $category)
    {

        $articles = $category->articles()->latest()->get();
        return view('category.show', compact('category', 'articles'));
    }
}
