<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class WebhookCreated extends Webhook
{
    public function getSecret(): string
    {
        $data = $this->getData();
        return $data['secret'];
    }
}
