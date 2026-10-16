<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class RevisorDashboard extends Component
{
    public $lastEditedArticle;

    public function mount()
    {

        $this->lastEditedArticle = session('lastEditedArticle');
    }

    public function acceptArticle($articleId)
    {
        return redirect()->route('revisor.accept', ['article' => $articleId]);
    }

    public function rejectArticle($articleId)
    {
        return redirect()->route('revisor.reject', ['article' => $articleId]);
    }

    public function undoLastAction()
    {
        return redirect()->route('revisor.undo');
    }

    public function render()
    {
        $articleToReview = Article::where('is_accepted', null)->first();


        $this->lastEditedArticle = session('lastEditedArticle');

        return view('livewire.revisor-dashboard', compact('articleToReview'));
    }
}
