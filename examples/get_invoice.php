<?php

// Include autoload file.
require __DIR__ . '/../vendor/autoload.php';

// Import Invoice client class.
use ProsusPay\Client\Invoice;

// Fill in with your Prosus Pay data.
$apiKey = '';
$host = ''; // e.g. https://your.prosuspay-server.tld
$storeId = '';
$invoiceId = '';

// Get information about a specific invoice.
try {
    echo 'Get invoice data:' . PHP_EOL;
    $client = new Invoice($host, $apiKey);
    var_dump($client->getInvoice($storeId, $invoiceId));
    echo 'Get invoice payment methods:' . PHP_EOL;
    var_dump($client->getPaymentMethods($storeId, $invoiceId));
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}
