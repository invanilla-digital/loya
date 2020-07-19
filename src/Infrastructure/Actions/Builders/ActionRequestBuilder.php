<?php

declare(strict_types=1);

namespace App\Infrastructure\Actions\Builders;

use App\Application\Actions\ActionRequestBuilderInterface;
use App\Domain\Actions\ActionRequest;
use App\Domain\Actions\ActionRequestInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;

class ActionRequestBuilder implements ActionRequestBuilderInterface
{
    protected string $type;
    protected array $payload = [];
    protected Collection $executors;
    protected ?ActionRequestInterface $request = null;
    private bool $completed = false;
    protected array $changes = [];

    public function __construct()
    {
        $this->executors = new ArrayCollection();
    }

    public function type(string $type): self
    {
        $this->changes[] = 'type';

        $this->type = $type;

        return $this;
    }

    public function withPayload(array $payload): self
    {
        $this->changes[] = 'payload';

        $this->payload = $payload;

        return $this;
    }

    public function withExecutor(UserInterface $user): self
    {
        $this->changes[] = 'executors';

        if (!$this->executors->contains($user)) {
            $this->executors->add($user);
        }

        return $this;
    }

    public function withExecutors(Collection $executors): self
    {
        $this->changes[] = 'executors';

        $this->executors = $executors;
    }

    public function completed(): self
    {
        $this->changes[] = 'completed';

        $this->completed = true;

        return $this;
    }

    public function incompleted(): self
    {
        $this->changes[] = 'completed';

        $this->completed = false;

        return $this;
    }

    public function rebuild(ActionRequestInterface $request): ActionRequestInterface
    {
        $this->request = $request;

        return $this->build();
    }

    public function build(): ActionRequestInterface
    {
        $this->request = $this->request ?: new ActionRequest();

        if (in_array('payload', $this->changes, true)) {
            $this->request->setPayload($this->payload);
        }

        if (in_array('type', $this->changes, true)) {
            $this->request->setRequestType($this->type);
        }

        if (in_array('executors', $this->changes, true)) {
            $this->request->setExecutors($this->executors);
        }

        if (in_array('completed', $this->changes, true)) {
            $this->request->setIsCompleted($this->completed);
        }

        $this->reset();

        return $this->request;
    }

    protected function reset(): void
    {
        $this->changes = [];
        $this->executors = new ArrayCollection();
        $this->payload = [];
        $this->type = '';
        $this->completed = false;
    }
}