<?php

declare(strict_types=1);

namespace App\Application\Navigation;

use App\Domain\Navigation\NavigationSection;

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
}