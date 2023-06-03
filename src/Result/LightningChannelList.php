<?php

declare(strict_types=1);

namespace ProsusPay\Result;

class LightningChannelList extends AbstractListResult
{
    /**
     * @return \ProsusPay\Result\LightningChannel[]
     */
    public function all(): array
    {
        $channels = [];
        foreach ($this->getData() as $channel) {
            $channels[] = new \ProsusPay\Result\LightningChannel($channel);
        }
        return $channels;
    }
}
