<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    //datos para acceder a la API Vision,
    //hay que combrobar a que carpeta mira el servidor y si es Ubuntu cambiar contrabarra \\ a barra normal /
    'google' => [
        'vision' => [
            'json-key' =>  dirname(__DIR__, 1) . '\\' . env('GOOGLE_APPLICATION_CREDENTIALS'),
            'project-id' => env('GOOGLE_CLOUD_PROJECT')
        ]
    ],

    //para conectrase a la API de recetas,
    'spoonacular' => [
        'api_key' => env('spoonacular_api_key')
    ]
];
