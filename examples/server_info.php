<?php

require __DIR__ . '/../vendor/autoload.php';

use ProsusPay\Client\Server;

// Fill in with your Prosus Pay data.
$apiKey = '';
$host = ''; // e.g. https://your.prosuspay-server.tld

// Get information about store on Prosus Pay.
try {
    $client = new Server($host, $apiKey);
    var_dump($client->getInfo());
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}
