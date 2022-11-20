<?php

namespace Defro\ColourLovers\Exception;

use Throwable;

class ColourLoversException extends \RuntimeException
{
    public function __construct(
        string $message,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
