<?php

declare(strict_types=1);

namespace App\Domain\Actions;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

interface ActionRequestRepositoryInterface
{
    public function find(string $uuid): ?ActionRequestInterface;

    public function findByExecutor(UserInterface $executor): Collection;

    public function create(ActionRequestInterface $request): void;

    public function update(ActionRequestInterface $request): void;

    public function delete(ActionRequestInterface $request): void;
}