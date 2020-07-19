<?php

declare(strict_types=1);

namespace App\Infrastructure\Actions\Services;

use App\Application\Actions\ActionRequestPresenterInterface;
use App\Domain\Actions\ActionRequestRepositoryInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

class ActionRequestPresentationService implements ActionRequestPresenterInterface
{
    private ActionRequestRepositoryInterface $actions;

    public function __construct(ActionRequestRepositoryInterface $actions)
    {
        $this->actions = $actions;
    }

    public function getPendingRequestsForUser(UserInterface $executor): Collection
    {
        return $this->actions->findByExecutor($executor);
    }
}