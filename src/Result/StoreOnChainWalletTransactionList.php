<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class StoreOnChainWalletTransactionList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\StoreOnChainWalletTransaction[]
     */
    public function all(): array
    {
        $storeWalletTransactions = [];
        foreach ($this->getData() as $storeWalletTransaction) {
            $storeWalletTransactions[] = new \ProsusPay\Result\StoreOnChainWalletTransaction($storeWalletTransaction);
        }
        return $storeWalletTransactions;
    }
}
