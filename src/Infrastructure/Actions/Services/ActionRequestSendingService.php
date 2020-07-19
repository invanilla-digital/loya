<?php

declare(strict_types=1);

namespace App\Infrastructure\Actions\Services;

use App\Application\Actions\ActionRequestBuilderInterface;
use App\Application\Actions\ActionRequestSenderInterface;
use App\Domain\Actions\ActionRequestInterface;
use App\Domain\Actions\ActionRequestRepositoryInterface;
use Doctrine\Common\Collections\Collection;

class ActionRequestSendingService implements ActionRequestSenderInterface
{
    protected ActionRequestBuilderInterface $builder;
    protected ActionRequestRepositoryInterface $actions;

    public function __construct(ActionRequestBuilderInterface $builder, ActionRequestRepositoryInterface $actions)
    {
        $this->builder = $builder;
        $this->actions = $actions;
    }

    public function send(ActionRequestInterface $request, Collection $executors = null): bool
    {
        // Don't resend existing action requests
        if ($request->getId()) {
            return false;
        }

        // Override original executors if required
        if ($executors) {
            $request = $this->builder->withExecutors($executors)->rebuild($request);
        }

        // There are no action executors to notify
        if ($request->getExecutors()->isEmpty()) {
            return false;
        }

        // Persist action in database
        $this->actions->create($request);

        return true;
    }
}