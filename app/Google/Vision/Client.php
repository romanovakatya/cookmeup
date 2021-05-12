<?php

namespace App\Google\Vision;

use Google\ApiCore\ApiException;
use Google\ApiCore\ValidationException;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Likelihood;
use Illuminate\Support\Arr;


class Client
{
    /**
     * @throws ValidationException
     */
    public static function getIngredients($photo): array
    {
        $options = ['credentials' => config('services.google.vision.json-key')];

        $imageAnnotatorClient = new ImageAnnotatorClient($options);

        $arrayObjects = [];

        try {
           // dd(base_path() . '\\storage\\app\\public\\2.jpg');
            //$imageResource = fopen(base_path() . '\\storage\\app\\public\\2.jpg', 'r');

            //$features = [Type::OBJECT_LOCALIZATION, Type::LABEL_DETECTION, Type::IMAGE_PROPERTIES,Type::TYPE_UNSPECIFIED];
            //$annotations = $imageAnnotatorClient->annotateImage($imageResource, $features);
            //dd(url('photos') . '/' . $photo->code);
            //
            $imageResource = fopen(public_path(('photos'). '\\' . $photo->code), 'r');
            //dd($imageResource);

            //Response to an image annotations request.
            //devuelve objeto con todos tipos de annotaciones (face, label, logo, text,...),
            $annotations = $imageAnnotatorClient->objectLocalization($imageResource);
            //dd($annotations);

            //!!!!!!!!!!!!!!!añadir comprobación en el caso si no hay objetos en la foto!!!!!!!

            //para obtener las caracteristacas de los objetos detectados,
            //https://github.com/protocolbuffers/protobuf-php/blob/v3.15.8/src/Google/Protobuf/Internal/RepeatedField.php
            //return object RepeatedField (legacy_klass, klass, type, container[LocalizedObjectAnnotation,...])
            $localizedObjects = $annotations->getLocalizedObjectAnnotations();
            //dd($localizedObjects);

            //para acceder al contenido del container:
            for ($counter = 0; $counter < $localizedObjects->count(); $counter++) {
                //offsetGet($counter)
                //Return the element at the given index.
                $localizedObject = $localizedObjects->offsetGet($counter);

                //printf($localizedObject->getName());

                //devolvemos el array de los nombres de los objetos detectados,
                //como keys de array usamos valor para evitar que se duplican los valores,
                //array_push($arrayObjects, $localizedObject->getName());
                $arrayObjects = Arr::add($arrayObjects, strtoupper($localizedObject->getName()), strtoupper($localizedObject->getName()));
            }
        } catch (ApiException $e) {
            printf($e);
        }
        catch (\ErrorException $e) {
        }
        finally {
            $imageAnnotatorClient->close();
        }
        return $arrayObjects;
    }
}
