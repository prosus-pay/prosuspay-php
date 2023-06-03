<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class StoreOnChainWalletTransactionDestinationList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\StoreOnChainWalletTransactionDestination[]
     */
    public function all(): array
    {
        $destinations = [];
        foreach ($this->getData() as $destination) {
            $destinations[] = new \ProsusPay\Result\StoreOnChainWalletTransactionDestination($destination);
        }
        return $destinations;
    }
}
