<?php

namespace App\Jobs;

use App\Models\Image;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\Image as VisionImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class GoogleVisionSafeSearch implements ShouldQueue
{
    use Queueable;

    private $image_id;

    public function __construct($image_id)
    {
        $this->image_id = $image_id;
    }

    public function handle(): void
    {
        $i = Image::find($this->image_id);
        if (!$i) {
            return;
        }

        $image = file_get_contents(storage_path('app/public/' . $i->path));


        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . base_path('google_credential.json'));

        $googleVisionClient = new ImageAnnotatorClient();

        $google_image = new VisionImage([
            'content' => $image
        ]);

        $googleFeature = new Feature();
        $googleFeature->setType(Type::SAFE_SEARCH_DETECTION);

        $request = new AnnotateImageRequest();
        $request->setImage($google_image);
        $request->setFeatures([$googleFeature]);

        $batchRequest = new BatchAnnotateImagesRequest();
        $batchRequest->setRequests([$request]);

        $responseBatch = $googleVisionClient->batchAnnotateImages($batchRequest);


        $responses = $responseBatch->getResponses();
        $response = $responses[0];

        $googleVisionClient->close();

        $safeSearchAnnotation = $response->getSafeSearchAnnotation();

        $adult = $safeSearchAnnotation->getAdult();
        $spoof = $safeSearchAnnotation->getSpoof();
        $medical = $safeSearchAnnotation->getMedical();
        $violence = $safeSearchAnnotation->getViolence();
        $racy = $safeSearchAnnotation->getRacy();

        $i->adult = $adult;
        $i->spoof = $spoof;
        $i->medical = $medical;
        $i->violence = $violence;
        $i->racy = $racy;

        $i->save();
    }
}
