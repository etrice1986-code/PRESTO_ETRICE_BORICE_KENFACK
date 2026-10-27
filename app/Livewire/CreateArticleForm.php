<?php

namespace App\Livewire;

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateArticleForm extends Component
{
    use WithFileUploads;


    public $title;
    public $description;
    public $price;
    public $category_id;


    public $images = [];
    public $temporary_images;


    protected $rules = [
        'title' => 'required|min:4',
        'description' => 'required|min:10',
        'price' => 'required|numeric',
        'category_id' => 'required',
        'images.*' => 'image|max:2048',
    ];


    public function updatedTemporaryImages()
    {
        $this->validate([
            'temporary_images.*' => 'image|max:2048',
        ], [
            'temporary_images.*.max' => 'L\'immagine è troppo grande (max 2MB).',
            'temporary_images.*.image' => 'Il file deve essere un\'immagine.',
        ]);

        foreach ($this->temporary_images as $image) {
            $this->images[] = $image;
        }
    }



    public function removeImage($key)
    {
        if (array_key_exists($key, $this->images)) {
            unset($this->images[$key]);

            $this->images = array_values($this->images);
        }
    }

    public function store()
    {
        $this->validate();


        $article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => Auth::id(),
            'is_accepted' => null,
        ]);

        if (count($this->images) > 0) {
            foreach ($this->images as $image) {

                $newFileName = "articles/{$article->id}";
                $newImage = $article->images()->create([
                    'path' => $image->store($newFileName, 'public')
                ]);


                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 300, 300),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);
            }


            File::deleteDirectory(storage_path('/app/livewire-tmp'));
        }




        session()->flash('message', 'Annuncio inserito con successo! Verrà pubblicato dopo la revisione.');
        $this->cleanForm();
    }

    private function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->price = '';
        $this->category_id = '';
        $this->images = [];
        $this->temporary_images = null;
    }

    public function render()
    {
        $categories = Category::all();
        return view('livewire.create-article-form', compact('categories'));
    }
}
