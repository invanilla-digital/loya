<?php

declare(strict_types=1);

namespace App\Domain\Actions;

use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\UuidInterface;

interface ActionRequestInterface
{
    public const TYPE_ROLE_CHANGE = 'role_change';

    public function getId(): ?UuidInterface;

    public function getRequestType(): string;

    public function getPayload(): array;

    public function isCompleted(): bool;

    public function getExecutors(): Collection;
}