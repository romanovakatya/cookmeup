<?php

namespace App\Google\Vision;

use Google\ApiCore\ApiException;
use Google\ApiCore\ValidationException;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;


class Client
{
    /**
     * @throws ValidationException
     */
    public static function getIngredients($photo)
    {
        ini_set("mbstring.func_overload", 0);
        //dd(PHP_INT_MAX);

        $options = ['credentials' => config('services.google.vision.json-key')];

        $imageAnnotatorClient = new ImageAnnotatorClient($options);

        $arrayObjects = [];

        try {

            $imageResource = fopen(public_path(('photos'). '\\' . $photo->code), 'r');
            //dd($imageResource);

            //Response to an image annotations request.
            //devuelve objeto con todos tipos de annotaciones (face, label, logo, text,...),
            $annotations = $imageAnnotatorClient->objectLocalization($imageResource);
            //dd($annotations);

            //para obtener las caracteristacas de los objetos detectados,
            //https://github.com/protocolbuffers/protobuf-php/blob/v3.15.8/src/Google/Protobuf/Internal/RepeatedField.php
            //return object RepeatedField (legacy_klass, klass, type, container[LocalizedObjectAnnotation,...])
            $localizedObjects = $annotations->getLocalizedObjectAnnotations();
            //dd($localizedObjects);

            //para acceder al contenido del container:
            for ($counter = 0; $counter < $localizedObjects->count(); $counter++) {

                //Return the element at the given index.
                $localizedObject = $localizedObjects->offsetGet($counter);

                //printf($localizedObject->getName());

                //devolvemos el array de los nombres de los objetos detectados,
                //como keys de array usamos valor para evitar que se duplican los valores,

                $newObject = strtoupper($localizedObject->getName());
                //dd($newObject);

                if (!in_array($newObject, $arrayObjects)){
                    array_push($arrayObjects, $newObject);
                }
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
