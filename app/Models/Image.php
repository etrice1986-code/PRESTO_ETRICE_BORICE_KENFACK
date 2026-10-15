<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['path', 'article_id'])]
class Image extends Model
{

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}
