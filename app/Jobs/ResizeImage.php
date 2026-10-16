<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image;
use Spatie\Image\Enums\CropPosition;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $path;
    protected $fileName;
    protected $w;
    protected $h;

    public function __construct($filePath, $w, $h)
    {
        $this->path = dirname($filePath);
        $this->fileName = basename($filePath);
        $this->w = $w;
        $this->h = $h;
    }

    public function handle(): void
    {
        $srcPath = storage_path('app/public/' . $this->path . '/' . $this->fileName);
        $destPath = storage_path('app/public/' . $this->path . '/crop_' . $this->w . 'x' . $this->h . '_' . $this->fileName);

        Image::load($srcPath)
            ->crop($this->w, $this->h, CropPosition::Center)
            ->save($destPath);
    }
}
