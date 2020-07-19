<?php

declare(strict_types=1);

namespace App\Application\Actions;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

interface ActionRequestPresenterInterface
{
    public function getPendingRequestsForUser(UserInterface $executor): Collection;
}