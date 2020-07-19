<?php

declare(strict_types=1);

namespace App\Application\Actions;

use App\Domain\Actions\ActionRequestInterface;
use Doctrine\Common\Collections\Collection;

interface ActionRequestSenderInterface
{
    public function send(ActionRequestInterface $request, Collection $executors): bool;
}