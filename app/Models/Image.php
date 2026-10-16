<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['path', 'article_id'];


    public function article()
    {
        return $this->belongsTo(Article::class);
    }



    public function getUrl($w = null, $h = null)
    {
        if (!$w || !$h) {
            return Storage::url($this->path);
        }

        $path = dirname($this->path);
        $fileName = basename($this->path);

        $folder = ($path === '.') ? 'articles' : $path;

        $cropFile = $folder . '/crop_' . $w . 'x' . $h . '_' . $fileName;

        if (Storage::disk('public')->exists($cropFile)) {
            return Storage::url($cropFile);
        }

        return Storage::url($this->path);
    }



    public function hasCrop($w, $h)
    {
        $path = dirname($this->path);
        $fileName = basename($this->path);

        $cropFile = $path . '/crop_' . $w . 'x' . $h . '_' . $fileName;

        return Storage::exists($cropFile);
    }
}
