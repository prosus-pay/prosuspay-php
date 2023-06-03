<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class NotificationList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\Notification[]
     */
    public function all(): array
    {
        $notifications = [];
        foreach ($this->getData() as $notification) {
            $notifications[] = new \ProsusPay\Result\Notification($notification);
        }
        return $notifications;
    }
}
