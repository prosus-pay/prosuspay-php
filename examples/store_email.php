<?php

require __DIR__ . '/../vendor/autoload.php';

use ProsusPay\Client\StoreEmail;

// Fill in with your Prosus Pay data.
$apiKey = '';
$host = ''; // e.g. https://your.prosuspay-server.tld
$storeId = '';

$server = '';
$port = '';
$username = '';
$password = '';
$fromEmail = '';
$fromName = 'John Doe';
$disableCertificateCheck = false;

$recipient = '';
$subject = 'Testmail from ProsusPay';
$body = "Let's see if we can have multiple lines \n\n this should be below. \n\n Enjoy";

// List all store users.
echo "\n List email settings \n";
try {
    $client = new StoreEmail($host, $apiKey);
    var_dump($client->getSettings($storeId));
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}

// Update store email settings.
echo "\n Update store email settings \n";
try {
    $client = new StoreEmail($host, $apiKey);
    $updated = $client->updateSettings(
        $storeId,
        $server,
        $port,
        $username,
        $password,
        $fromEmail,
        $fromName,
        $disableCertificateCheck
    );

    var_dump($updated);
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}

// Send an email.
echo "\n Send an email. \n:";
try {
    $client = new StoreEmail($host, $apiKey);
    var_dump($client->sendMail($storeId, $recipient, $subject, $body));
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}
