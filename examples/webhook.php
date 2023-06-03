<?php

declare(strict_types=1);

// Include autoload file.
require __DIR__ . '/../vendor/autoload.php';

// Import Invoice client class.
use ProsusPay\Client\Invoice;
use ProsusPay\Client\Webhook;

class WebhookExample
{
    public $apiKey;
    public $host;
    public $storeId;
    public $secret;
    public $webhookId;

    public function __construct()
    {
        // Fill in with your Prosus Pay data.
        $this->apiKey = '';
        $this->host = ''; // e.g. https://your.prosuspay-server.tld
        $this->storeId = '';
        $this->secret = ''; // webhook secret as shown in the webhook UI / returned by createWebhook()
        $this->webhookId = ''; // only needed for the updateWebhook() example.
    }

    public function processWebhook()
    {
        $myfile = fopen("ProsusPay.log", 'ab');
        $raw_post_data = file_get_contents('php://input');

        $date = date('m/d/Y h:i:s a');

        if (false === $raw_post_data) {
            fwrite(
                $myfile,
                $date . " : Error. Could not read from the php://input stream or invalid ProsusPay payload received.\n"
            );
            fclose($myfile);
            throw new \RuntimeException(
                'Could not read from the php://input stream or invalid ProsusPay payload received.'
            );
        }

        $payload = json_decode($raw_post_data, false, 512, JSON_THROW_ON_ERROR);

        if (empty($payload)) {
            fwrite(
                $myfile,
                $date . " : Error. Could not decode the JSON payload from ProsusPay.\n"
            );
            fclose($myfile);
            throw new \RuntimeException('Could not decode the JSON payload from ProsusPay.');
        }

        // verify hmac256
        $headers = getallheaders();
        foreach ($headers as $key => $value) {
            if (strtolower($key) === 'prosuspay-sig') {
                $sig = $value;
            }
        }

        $webhookClient = new Webhook($this->host, $this->apiKey);

        if (!$webhookClient->isIncomingWebhookRequestValid($raw_post_data, $sig, $this->secret)) {
            fwrite(
                $myfile,
                $date . " : Error. Invalid Signature detected! \n was: " . $sig . " should be: " . hash_hmac(
                    'sha256',
                    $raw_post_data,
                    $this->secret
                ) . "\n"
            );
            fclose($myfile);
            throw new \RuntimeException(
                'Invalid ProsusPay payment notification message received - signature did not match.'
            );
        }

        if (true === empty($payload->invoiceId)) {
            fwrite(
                $myfile,
                $date . " : Error. Invalid ProsusPay payment notification message received - did not receive invoice ID.\n"
            );
            fclose($myfile);
            throw new \RuntimeException(
                'Invalid ProsusPay payment notification message received - did not receive invoice ID.'
            );
        }

        // Load an existing invoice with the provided invoiceId.
        // Most of the time this is not needed as you can listen to specific webhook events
        // See: https://docs.prosuspayserver.org/API/Greenfield/v1/#tag/Webhooks/paths/InvoiceCreated/post
        try {
            $client = new Invoice($this->host, $this->apiKey);
            $invoice = $client->getInvoice($this->storeId, $payload->invoiceId);
        } catch (\Throwable $e) {
            fwrite($myfile, "Error: " . $e->getMessage());
            throw $e;
        }

        // optional: check whether your webhook is of the desired type
        if ($payload->type !== "InvoiceSettled") {
            throw new \RuntimeException(
                'Invalid payload message type. Only InvoiceSettled is supported, check the configuration of the webhook.'
            );
        }

        $invoicePrice = $invoice->getData()['amount'];
        $buyerEmail = $invoice->getData()['metadata']['buyerEmail'];

        fwrite(
            $myfile,
            $date . " : Payload received for ProsusPay invoice " . $payload->invoiceId . " Type: " . $payload->type . " Price: " . $invoicePrice . " E-Mail: " . $buyerEmail . "\n"
        );
        fwrite($myfile, "Raw payload: " . $raw_post_data . "\n");

        // your own processing code goes here!

        echo 'OK';
    }

    public function createWebhook()
    {
        $url = 'https://createdurl.test.example.com/webhook';
        $specificEvents = [
          'InvoiceExpired',
          'InvoiceSettled',
          'InvoiceInvalid'
        ];

        try {
            $client = new \ProsusPay\Client\Webhook($this->host, $this->apiKey);
            var_dump($client->createWebhook($this->storeId, $url, $specificEvents, null));
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateWebhook()
    {
        $url = 'https://updatedurl.test.example.com/webhook';
        $specificEvents = [
          'InvoiceReceivedPayment',
          'InvoicePaymentSettled',
          'InvoiceProcessing',
          'InvoiceExpired',
          'InvoiceSettled',
          'InvoiceInvalid'
        ];

        try {
            $client = new \ProsusPay\Client\Webhook($this->host, $this->apiKey);
            var_dump($client->updateWebhook($this->storeId, $url, $this->webhookId, $specificEvents));
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getWebhook()
    {
        try {
            $client = new \ProsusPay\Client\Webhook($this->host, $this->apiKey);
            var_dump($client->getWebhook($this->storeId, $this->webhookId));
        } catch (\Throwable $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

$wh = new WebhookExample();
//$wh->processWebhook();
//$wh->createWebhook();
//$wh->getWebhook();
//$wh->updateWebhook();
