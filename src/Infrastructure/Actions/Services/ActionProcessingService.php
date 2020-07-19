<?php

declare(strict_types=1);

namespace App\Infrastructure\Actions\Services;

use App\Application\Actions\ActionHandlerFactoryInterface;
use App\Application\Actions\ActionProcessorInterface;
use App\Domain\Actions\ActionRequestInterface;
use App\Infrastructure\Actions\Exceptions\InvalidStatusException;
use App\Infrastructure\Actions\Exceptions\UnauthorizedAccessException;
use Symfony\Component\Security\Core\User\UserInterface;

class ActionProcessingService implements ActionProcessorInterface
{
    private ActionHandlerFactoryInterface $handlers;

    public function __construct(ActionHandlerFactoryInterface $handlers)
    {
        $this->handlers = $handlers;
    }

    public function complete(ActionRequestInterface $request, UserInterface $executor): void
    {
        $this->validatePermissionsToExecute($request, $executor);

        $this->handlers->make($request->getRequestType())->complete($request, $executor);
    }

    public function undo(ActionRequestInterface $request, UserInterface $executor): void
    {
        $this->validatePermissionsToExecute($request, $executor);

        if (!$request->isCompleted()) {
            InvalidStatusException::throw('Action ' . $request->getId() . ' is not yet completed');
        }

        $this->handlers->make($request->getRequestType())->complete($request, $executor);
    }

    protected function validatePermissionsToExecute(ActionRequestInterface $request, UserInterface $executor): void
    {
        if (!$request->getExecutors()->contains($executor)) {
            UnauthorizedAccessException::throw(
                $executor->getUsername() . ' is not allowed to undo action ' . $request->getId()
            );
        }
    }
}