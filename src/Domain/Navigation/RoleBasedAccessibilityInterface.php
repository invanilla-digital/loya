<?php

declare(strict_types=1);

namespace App\Domain\Navigation;

interface RoleBasedAccessibilityInterface
{
    public function getRoles(): array;

    public function isAccessibleByRole(string $role): bool;
}