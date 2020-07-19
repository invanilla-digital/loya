<?php

declare(strict_types=1);

namespace App\Application\Actions;

interface ActionHandlerFactoryInterface
{
    public function make(string $type): ActionHandlerInterface;
}