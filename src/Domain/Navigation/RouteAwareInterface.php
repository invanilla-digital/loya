<?php

declare(strict_types=1);

namespace App\Domain\Navigation;

interface RouteAwareInterface
{
    public function getRoute(): string;
}