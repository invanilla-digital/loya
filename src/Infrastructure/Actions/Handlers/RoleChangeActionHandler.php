<?php

declare(strict_types=1);

namespace App\Infrastructure\Actions\Handlers;

use App\Application\Actions\ActionHandlerInterface;
use App\Domain\Actions\ActionRequestInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RoleChangeActionHandler implements ActionHandlerInterface
{
    public function complete(ActionRequestInterface $request, UserInterface $executor): void
    {
    }

    public function incomplete(ActionRequestInterface $request, UserInterface $executor): void
    {
    }
}