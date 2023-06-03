<?php

declare(strict_types=1);

namespace ProsusPay\Result;

use ProsusPay\Util\PreciseNumber;

class StoreOnChainWallet extends AbstractResult
{
    public function getBalance(): PreciseNumber
    {
        $data = $this->getData();
        return PreciseNumber::parseString($data['balance']);
    }

    public function getUnconfirmedBalance(): PreciseNumber
    {
        $data = $this->getData();
        return PreciseNumber::parseString($data['unconfirmedBalance']);
    }

    public function getConfirmedBalance(): PreciseNumber
    {
        $data = $this->getData();
        return PreciseNumber::parseString($data['confirmedBalance']);
    }
}
