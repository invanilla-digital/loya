<?php

declare(strict_types=1);

namespace App\Domain\Navigation;

final class MenuItem implements RoleBasedAccessibilityInterface, UrlAwareInterface
{
    private string $title;
    private string $url;
    private array $items;
    private array $roles;

    public function __construct(string $title = '', string $url = '', array $items = [], array $roles = [])
    {
        $this->title = $title;
        $this->url = $url;
        $this->items = $items;
        $this->roles = $roles;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
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