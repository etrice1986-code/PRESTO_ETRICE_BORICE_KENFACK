<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\Image\Image;
use Spatie\Image\Enums\CropPosition;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;


    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle(): void
    {

        $disk = Storage::disk('public');

        if (!$disk->exists($this->filePath)) {
            return;
        }


        $srcPath = $disk->path($this->filePath);

        $pathInfo = pathinfo($this->filePath);
        $dirname = $pathInfo['dirname'] === '.' ? '' : $pathInfo['dirname'] . '/';
        $fileName = $pathInfo['basename'];

        $sizes = [
            [300, 300],
            [400, 300],
            [600, 400],
            [800, 600],
        ];

        foreach ($sizes as [$w, $h]) {

            $newFileName = $dirname . 'crop_' . $w . 'x' . $h . '_' . $fileName;
            $destPath = $disk->path($newFileName);

            Image::load($srcPath)
                ->crop($w, $h, CropPosition::Center)
                ->save($destPath);
        }
    }
}
