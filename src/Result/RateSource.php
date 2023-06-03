<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class RateSource extends AbstractResult
{
    public function getId(): string
    {
        return $this->getData()['id'];
    }

    public function getName(): string
    {
        return $this->getData()['name'];
    }
}
