<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateArticleForm extends Component
{
    // Proprietà legate ai campi del form
    public $title;
    public $description;
    public $price;
    public $category_id;


    protected $rules = [
        'title' => 'required|min:4|max:100',
        'description' => 'required|min:10',
        'price' => 'required|numeric|min:0.01',
        'category_id' => 'required|exists:categories,id',
    ];


    protected $messages = [
        'required' => 'Questo campo è obbligatorio.',
        'numeric' => 'Il prezzo deve essere un numero.',
        'min' => 'Il valore inserito è troppo corto o basso.',
    ];


    public function store()
    {

        $this->validate();


        Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => Auth::id(),
        ]);


        session()->flash('message', 'Annuncio inserito con successo!');


        $this->cleanForm();
    }


    public function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category_id = '';
    }

    public function render()
    {

        return view('livewire.create-article-form', [
            'categories' => Category::all()
        ]);
    }
}
