<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = [
        'path',
        'article_id',
        'labels',
        'adult',
        'spoof',
        'medical',
        'violence',
        'racy'
    ];

    protected function casts(): array
    {
        return [
            'labels' => 'array',
        ];
    }

    public function article()
    {
        return $this->belongsTo(Article::class);
    }


    public function getUrl($w = null, $h = null)
    {
        /** @var \Illuminate\Filesystem\FilesystemAdapter $disk */
        $disk = Storage::disk('public');


        if (!$w || !$h) {
            return $disk->url($this->path);
        }

        $pathInfo = pathinfo($this->path);
        $dirname = $pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'] . '/';
        $fileName = $pathInfo['basename'];


        $cropFile = $dirname . 'crop_' . $w . 'x' . $h . '_' . $fileName;


        if ($disk->exists($cropFile)) {
            return $disk->url($cropFile);
        }


        return $disk->url($this->path);
    }


    public function hasCrop($w, $h)
    {
        $pathInfo = pathinfo($this->path);
        $dirname = $pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'] . '/';
        $fileName = $pathInfo['basename'];

        $cropFile = $dirname . 'crop_' . $w . 'x' . $h . '_' . $fileName;


        return Storage::disk('public')->exists($cropFile);
    }
}
