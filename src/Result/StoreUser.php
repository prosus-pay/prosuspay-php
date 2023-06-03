<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class StoreUser extends AbstractResult
{
    public function getUserId(): string
    {
        $data = $this->getData();
        return $data['userId'];
    }

    public function getRole(): string
    {
        $data = $this->getData();
        return $data['role'];
    }
}
