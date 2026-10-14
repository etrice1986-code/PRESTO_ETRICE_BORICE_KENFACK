<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;

class RevisorDashboard extends Component
{

    public $lastEditedArticle = null;


    public function acceptArticle($articleId)
    {
        $article = Article::find($articleId);
        if ($article) {
            $article->update(['is_accepted' => true]);

            $this->lastEditedArticle = $article;
            session()->flash('message', "Annuncio '{$article->title}' accettato con successo.");
        }
    }


    public function rejectArticle($articleId)
    {
        $article = Article::find($articleId);
        if ($article) {
            $article->update(['is_accepted' => false]);

            $this->lastEditedArticle = $article;
            session()->flash('message', "Annuncio '{$article->title}' rifiutato.");
        }
    }


    public function undoLastAction()
    {
        if ($this->lastEditedArticle) {

            $article = Article::find($this->lastEditedArticle['id']);
            if ($article) {

                $article->update(['is_accepted' => null]);
                session()->flash('message', "Operazione annullata. L'annuncio '{$article->title}' è di nuovo in revisione.");

                $this->lastEditedArticle = null;
            }
        }
    }

    public function render()
    {

        $articleToReview = Article::where('is_accepted', null)->oldest()->first();

        return view('livewire.revisor-dashboard', compact('articleToReview'));
    }
}
