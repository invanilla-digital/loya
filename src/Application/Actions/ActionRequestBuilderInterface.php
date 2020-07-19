<?php

declare(strict_types=1);

namespace App\Application\Actions;

use App\Domain\Actions\ActionRequestInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

interface ActionRequestBuilderInterface
{
    public function rebuild(ActionRequestInterface $request): ActionRequestInterface;

    public function build(): ActionRequestInterface;

    public function type(string $type): self;

    public function withExecutor(UserInterface $user): self;

    public function incompleted(): self;

    public function completed(): self;

    public function withExecutors(Collection $executors): self;

    public function withPayload(array $payload): self;
}