<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class WebhookList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\Webhook[]
     */
    public function all(): array
    {
        $webhooks = [];
        foreach ($this->getData() as $webhook) {
            $webhooks[] = new \ProsusPay\Result\Webhook($webhook);
        }
        return $webhooks;
    }
}
