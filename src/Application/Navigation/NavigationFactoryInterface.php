<?php

declare(strict_types=1);

namespace App\Application\Navigation;

use App\Domain\Navigation\NavigationSection;

interface NavigationFactoryInterface
{
    /**
     * @param array $config
     * @return NavigationSection[]
     */
    public function make(array $config): array;
}