<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class WebhookDeliveryList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\WebhookDelivery[]
     */
    public function all(): array
    {
        $webhookDeliveries = [];
        foreach ($this->getData() as $webhookDelivery) {
            $webhookDeliveries[] = new \ProsusPay\Result\WebhookDelivery($webhookDelivery);
        }
        return $webhookDeliveries;
    }
}
