<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

final class DeleteEntityException extends Exception
{

    public function __construct(
        string $message = 'Error deleting the register',
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
