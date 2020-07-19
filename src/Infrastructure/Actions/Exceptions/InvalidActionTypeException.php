<?php

declare(strict_types=1);

namespace App\Infrastructure\Actions\Exceptions;

use InvalidArgumentException;

final class InvalidActionTypeException extends InvalidArgumentException
{
    public static function throw(string $message): void
    {
        throw new static($message);
    }
}