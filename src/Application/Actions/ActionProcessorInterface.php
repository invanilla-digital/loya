<?php

declare(strict_types=1);

namespace App\Application\Actions;

use App\Domain\Actions\ActionRequestInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface ActionProcessorInterface
{
    /**
     * @param ActionRequestInterface $request
     * @param UserInterface $executor
     * @return void
     *
     * @example User James has approved John's role change request. Mark ActionRequest as complete
     */
    public function complete(ActionRequestInterface $request, UserInterface $executor): void;

    /**
     * @param ActionRequestInterface $request
     * @param UserInterface $executor
     * @return void
     *
     * @example User James mistakenly approved John's role change request, incomplete the ActionRequest
     */
    public function undo(ActionRequestInterface $request, UserInterface $executor): void;
}