<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        if ($query) {

            $articles = Article::with('category')
                ->where('is_accepted', true)
                ->where('title', 'LIKE', '%' . $query . '%')
                ->latest()
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




    public function edit(Article $article)
    {

        abort_if($article->user_id != Auth::id(), 403);


        $categories = Category::orderBy('name')->get();


        return view('article.edit', compact('article', 'categories'));
    }



    public function update(Request $request, Article $article)
    {
        abort_if(
            $article->user_id !== Auth::id(),
            403
        );

        $article->update([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        return redirect()
            ->route('article.show', $article)
            ->with('message', 'Annuncio aggiornato correttamente');
    }

    public function myArticles()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $articles = $user->articles()
            ->latest()
            ->get();

        return view('article.my-articles', compact('articles'));
    }



    public function aboutUs()
    {
        return view('about-us');
    }





    public function contact()
    {
        return view('article.contact');
    }


    public function contactSubmit(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string',
            'message' => 'required|string|min:10',
        ]);


        if ($validatedData['subject'] === 'report') {
            $destinatario = 'abuse@presto.it';
        } else {
            $destinatario = 'supporto@presto.it';
        }


        \Illuminate\Support\Facades\Mail::to($destinatario)->send(
            new \App\Mail\ContactMail($validatedData)
        );


        return redirect()
            ->route('contact.us')
            ->with('success', 'Grazie per averci contattato! Il nostro team ti risponderà al più presto.');
    }





    public function categoryShow(Category $category)
    {
        $articles = $category->articles()
            ->where('is_accepted', true)
            ->latest()
            ->paginate(12);

        return view('category.show', compact('category', 'articles'));
    }


    public function destroy(Article $article)
    {
        abort_if(
            $article->user_id !== Auth::id(),
            403
        );

        $article->delete();

        return redirect()
            ->route('article.my')
            ->with('message', 'Annuncio eliminato correttamente.');
    }
}
