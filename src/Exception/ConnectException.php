<?php

declare(strict_types=1);

namespace ProsusPay\Exception;

class ConnectException extends ProsusPayException
{
    public function __construct(string $curlErrorMessage, int $curlErrorCode)
    {
        parent::__construct($curlErrorMessage, $curlErrorCode);
    }
}
