<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class PullPaymentPayoutList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\PullPaymentPayout[]
     */
    public function all(): array
    {
        $pullPaymentPayouts = [];
        foreach ($this->getData() as $pullPaymentPayoutData) {
            $pullPaymentPayouts[] = new \ProsusPay\Result\PullPaymentPayout($pullPaymentPayoutData);
        }
        return $pullPaymentPayouts;
    }
}
