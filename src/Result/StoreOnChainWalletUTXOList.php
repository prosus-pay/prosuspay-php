<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class StoreOnChainWalletUTXOList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\StoreOnChainWalletUTXO[]
     */
    public function all(): array
    {
        $storeWalletUTXOs = [];
        foreach ($this->getData() as $storeWalletUTXO) {
            $storeWalletUTXOs[] = new \ProsusPay\Result\StoreOnChainWalletUTXO($storeWalletUTXO);
        }
        return $storeWalletUTXOs;
    }
}
