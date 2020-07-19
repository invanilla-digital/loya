<?php

declare(strict_types=1);

namespace App\Infrastructure\Actions\Exceptions;

use RuntimeException;

final class UnauthorizedAccessException extends RuntimeException
{
    public static function throw(string $message): void
    {
        throw new static($message);
    }
}