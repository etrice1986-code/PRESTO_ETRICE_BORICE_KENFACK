<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            $articles = Article::search($query)
                ->query(function ($builder) {
                    $builder->where('is_accepted', true)->with('category');
                })
                ->paginate(12);
        } else {
            $articles = Article::with('category')
                ->where('is_accepted', true)
                ->latest()
                ->paginate(12);
        }

        return view('article.index', compact('articles', 'query'));
    }


    public function create()
    {
        return view('article.create');
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
            ->paginate(12);

        return view('category.show', compact('category', 'articles'));
    }
}
