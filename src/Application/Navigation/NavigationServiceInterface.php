<?php

declare(strict_types=1);

namespace App\Application\Navigation;

use App\Domain\Navigation\NavigationSection;
use App\Domain\Navigation\RoleBasedAccessibilityInterface;
use App\Domain\Navigation\RouteAwareInterface;

interface NavigationServiceInterface
{
    /**
     * @return NavigationSection[]
     */
    public function getSidebarSections(): array;

    /**
     * @return NavigationSection[]
     */
    public function getTopNavigationSections(): array;

    public function isItemAccessible(RoleBasedAccessibilityInterface $item): bool;

    public function isItemActive(RouteAwareInterface $item): bool;
}