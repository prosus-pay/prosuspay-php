<?php

declare(strict_types=1);

namespace ProsusPay\Result;

use ProsusPay\Util\PreciseNumber;

class StoreOnChainWalletTransactionDestination extends AbstractResult
{
    public function getDestination(): string
    {
        $data = $this->getData();
        return $data['destination'];
    }

    public function getAmount(): PreciseNumber
    {
        $data = $this->getData();
        return PreciseNumber::parseString($data['amount']);
    }

    public function subtractFromAmount(): bool
    {
        $data = $this->getData();
        return $data['subtractFromAmount'];
    }
}
