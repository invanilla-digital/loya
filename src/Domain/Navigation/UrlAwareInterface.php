<?php

declare(strict_types=1);

namespace App\Domain\Navigation;

interface UrlAwareInterface
{
    public function getUrl(): string;
}