<?php

namespace Defro\ColourLovers\Exception;

use Throwable;

class BadStatusCodeException extends \RuntimeException
{
    public function __construct(
        string $message,
        ?int $statusCode,
        Throwable $previous = null
    ) {
        parent::__construct($message, $statusCode, $previous);
    }
}
