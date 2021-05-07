<?php

namespace App\Google\Vision;

use Google\ApiCore\ApiException;
use Google\ApiCore\ValidationException;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Likelihood;



class Client
{
    /**
     * @throws ValidationException
     */
    public static function test()
    {

        $options = ['credentials' => config('services.google.vision.json-key')];

        $imageAnnotatorClient = new ImageAnnotatorClient($options);

        try {
            //$requests = [];
            //$response = $imageAnnotatorClient->batchAnnotateFiles($requests);
            //dd(base_path() . '\\storage\\app\\public\\VikaGena.jpeg');
            $imageResource = fopen(base_path() . '\\storage\\app\\public\\head.jpg', 'r');
            $features = [Type::FACE_DETECTION];
            $annotation = $imageAnnotatorClient->annotateImage($imageResource,$features);

// Determine if the detected faces have headwear.
            foreach ($annotation->getFaceAnnotations() as $faceAnnotation) {
                $likelihood = Likelihood::name($faceAnnotation->getHeadwearLikelihood());
                echo "Likelihood of headwear: $likelihood" . PHP_EOL;
            }

        } catch (ApiException $e) {
        } finally {
            $imageAnnotatorClient->close();
        }
    }
}
