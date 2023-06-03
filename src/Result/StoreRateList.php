<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class StoreRateList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\StoreRate[]
     */
    public function all(): array
    {
        $storeRates = [];
        foreach ($this->getData() as $rate) {
            $storeRates[] = new StoreRate($rate);
        }
        return $storeRates;
    }
}
