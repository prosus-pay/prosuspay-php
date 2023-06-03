<?php

require __DIR__ . '/../vendor/autoload.php';

use ProsusPay\Client\Miscellaneous;
use ProsusPay\Client\StoreRate;
use ProsusPay\Util\PreciseNumber;

// Fill in with your Prosus Pay data.
$apiKey = '';
$host = ''; // e.g. https://your.prosuspay-server.tld
$storeId = '';

$currencyPairs = [
    'BTC_EUR',
    'BTC_USD',
    'BTC_USDC'
];

// Get store rates.
echo "\n List store rates \n";
try {
    $client = new StoreRate($host, $apiKey);
    $rates = $client->getRates($storeId, $currencyPairs);
    var_dump($rates->all());

    foreach ($rates->all() as $rate) {
        var_dump($rate->hasRate());
    }
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}

// Get store rates.
echo "\n List all store rates \n";
try {
    $client = new StoreRate($host, $apiKey);
    $rates = $client->getRates($storeId, []);
    var_dump($rates->all());

    foreach ($rates->all() as $rate) {
        var_dump($rate->hasRate());
    }
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}

// Get store rate settings.
echo "\n List all store rate settings \n";
try {
    $client = new StoreRate($host, $apiKey);
    $settings = $client->getSettings($storeId);
    var_dump($settings);
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}

// Update store rate settings.
echo "\n Update store rate settings \n";
$spread = \ProsusPay\Util\PreciseNumber::parseFloat(0);
$isCustomScript = false;
$effectiveScript = null;
$preferredSource = "kraken";
try {
    $client = new StoreRate($host, $apiKey);
    $updatedSettings = $client->updateSettings(
        $storeId,
        $spread,
        $isCustomScript,
        $preferredSource,
        $effectiveScript
    );
    var_dump($updatedSettings);
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}

// List all rate sources.
echo "\n List all rate sources \n";
try {
    $client = new Miscellaneous($host, $apiKey);
    $sources = $client->getRateSources();
    var_dump($sources->all());
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}

// You can test your own rating rules like this.
echo "\n Preview rating rule \n";
$testSpread = PreciseNumber::parseFloat(0);
$testIsCustomScript = true;
$testEffectiveScript = "X_X = kraken(X_X) * 1.05;"; // not useful, just an example
$testPreferredSource = null;
$testCurrencyPairs = ['BTC_USD'];
try {
    $client = new StoreRate($host, $apiKey);
    $preview = $client->previewRateRules(
        $storeId,
        $testCurrencyPairs,
        $testSpread,
        $testIsCustomScript,
        $testPreferredSource,
        $testEffectiveScript
    );
    var_dump($preview);
} catch (\Throwable $e) {
    echo "Error: " . $e->getMessage();
}
