<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class StoreUserList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\StoreUser[]
     */
    public function all(): array
    {
        $storeUsers = [];
        foreach ($this->getData() as $userData) {
            $storeUsers[] = new StoreUser($userData);
        }
        return $storeUsers;
    }
}
