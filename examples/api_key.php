<?php

require __DIR__ . '/../vendor/autoload.php';

use ProsusPay\Client\ApiKey;

// Fill in with your Prosus Pay data.
$apiKey = '';
$host = ''; // e.g. https://your.prosuspay-server.tld
$userEmail = '';
$userId = '';

// Get information about store on Prosus Pay.
try {
    $client = new ApiKey($host, $apiKey);
    var_dump($client->getCurrent());
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}
/*
print("\nCreate a new api key (needs server modify permission of used api).\n");
try {
    $client = new Apikey($host, $apiKey);
    var_dump($client->createApiKey('api generated', ['prosuspay.store.canmodifystoresettings']));
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}
*/
print("\nCreate a new api key for different user. Needs unrestricted access\n");

try {
    $client = new Apikey($host, $apiKey);
    $uKey = $client->createApiKeyForUser($userEmail, 'api generated to be deleted', ['prosuspay.store.canmodifystoresettings']);
    var_dump($uKey);
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}


print("\nRevoke api key for different user.\n");

try {
    $client = new Apikey($host, $apiKey);
    $uKey = $client->revokeApiKeyForUser($userEmail, $uKey->getData()['apiKey']);
    var_dump($uKey);
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}
