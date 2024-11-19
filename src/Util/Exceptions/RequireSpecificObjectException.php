<?php

declare(strict_types=1);

namespace App\Util\Exceptions;

use Exception;

final class RequireSpecificObjectException extends Exception
{

    public function __construct(
        string $message = 'Error with the object type',
        int $code = 0
    )
    {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return $this->getMessage();
    }
}
