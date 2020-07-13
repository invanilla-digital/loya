<?php

declare(strict_types=1);

namespace App\Application\Navigation;

use App\Domain\Navigation\NavigationSection;

interface NavigationServiceInterface
{
    /**
     * @return NavigationSection[]
     */
    public function getMenuSections(): array;
}