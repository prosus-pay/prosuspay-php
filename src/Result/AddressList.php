<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class AddressList extends \ProsusPay\Result\AbstractListResult
{
    /**
     * @return \ProsusPay\Result\Address[]
     */
    public function all(): array
    {
        $r = [];
        foreach ($this->getData()['addresses'] as $addressData) {
            $r[] = new \ProsusPay\Result\Address($addressData);
        }
        return $r;
    }
}
