<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class PullPaymentList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\PullPayment[]
     */
    public function all(): array
    {
        $pullPayments = [];
        foreach ($this->getData() as $pullPaymentData) {
            $pullPayments[] = new \ProsusPay\Result\PullPayment($pullPaymentData);
        }
        return $pullPayments;
    }
}
