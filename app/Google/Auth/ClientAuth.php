<?php


namespace App\Google\Auth;
//namespace Google\Cloud\Samples\Auth;

// Imports the Cloud Storage client library.
use Google\Cloud\Storage\StorageClient;

class ClientAuth
{


    function auth_cloud_explicit($projectId, $serviceAccountPath)
    {
        # Explicitly use service account credentials by specifying the private key
        # file.
        $config = [
            'keyFilePath' => $serviceAccountPath,
            'projectId' => $projectId,
        ];
        $storage = new StorageClient($config);

        foreach($storage->bucket('cookmeup')->info() as $x){
            var_dump($x);
        }
        # Make an authenticated API request (listing storage buckets)
        foreach ($storage->buckets() as $bucket) {
            printf('Bucket: %s' . PHP_EOL, $bucket->name());
        }
    }
}
