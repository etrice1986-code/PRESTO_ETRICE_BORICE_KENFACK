<?php

namespace App\Jobs;

use App\Models\Image as ImageModel;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $image_id;


    public function __construct($image_id)
    {
        $this->image_id = $image_id;
    }


    public function handle(): void
    {
        $image = ImageModel::find($this->image_id);
        if (!$image) {
            return;
        }

        $imagePath = storage_path('app/public/' . $image->path);
        $imageContents = file_get_contents($imagePath);


        $imageAnnotator = new ImageAnnotatorClient();
        $response = $imageAnnotator->safeSearchDetection($imageContents);
        $safeSearch = $response->getSafeSearchAnnotation();

        if ($safeSearch) {

            $likelihoods = ['UNKNOWN', 'VERY_UNLIKELY', 'UNLIKELY', 'POSSIBLE', 'LIKELY', 'VERY_LIKELY'];

            $image->update([
                'adult'    => $likelihoods[$safeSearch->getAdult()],
                'spoof'    => $likelihoods[$safeSearch->getSpoof()],
                'medical'  => $likelihoods[$safeSearch->getMedical()],
                'violence' => $likelihoods[$safeSearch->getViolence()],
                'racy'     => $likelihoods[$safeSearch->getRacy()],
            ]);
        }

        $imageAnnotator->close();
    }
}
