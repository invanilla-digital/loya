<?php

declare(strict_types=1);

namespace App\Domain\Navigation;

final class NavigationSection implements RoleBasedAccessibilityInterface
{
    private string $title;
    private array $items;
    private array $roles;

    public function __construct(string $title, array $items = [], array $roles = [])
    {
        $this->title = $title;
        $this->items = $items;
        $this->roles = $roles;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function addItem(\Closure $closure): self
    {
        $this->items[] = $closure(new MenuItem);

        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function isAccessibleByRole(string $role): bool
    {
        return in_array($role, $this->roles, true);
    }
}