<?php

declare(strict_types=1);

namespace App\Application\Actions;

use App\Domain\Actions\ActionRequestInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface ActionHandlerInterface
{
    public function complete(ActionRequestInterface $request, UserInterface $executor): void;

    public function incomplete(ActionRequestInterface $request, UserInterface $executor): void;
}