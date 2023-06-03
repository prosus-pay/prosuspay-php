<?php

declare(strict_types=1);

namespace ProsusPay\Result;

abstract class AbstractListResult extends AbstractResult implements \Countable
{
    public function count(): int
    {
        return count($this->getData());
    }
}
