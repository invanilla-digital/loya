<?php

declare(strict_types=1);

namespace App\Domain\Actions;

use App\Domain\Common\Traits\HasTimestamps;
use App\Domain\Common\Traits\HasUuid;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="action_requests")
 *
 * In Loya some system events may require user confirmations or interactions
 * ex. User password has to be changed, report has to be reviewed
 */
class ActionRequest implements ActionRequestInterface
{
    use HasUuid;
    use HasTimestamps;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    protected ?string $requestType = null;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": false})
     */
    protected bool $isCompleted = false;

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    protected array $payload = [];

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Domain\Users\User", mappedBy="actionRequests")
     */
    protected Collection $executors;

    public function __construct()
    {
        $this->executors = new ArrayCollection();
    }

    public function getRequestType(): string
    {
        return (string)$this->requestType;
    }

    public function setRequestType(?string $requestType): void
    {
        $this->requestType = $requestType;
    }

    public function isCompleted(): bool
    {
        return $this->isCompleted;
    }

    public function setIsCompleted(bool $isCompleted): void
    {
        $this->isCompleted = $isCompleted;
    }

    public function getPayload(): array
    {
        return $this->payload ?: [];
    }

    public function setPayload(array $payload): void
    {
        $this->payload = $payload;
    }

    public function getExecutors(): Collection
    {
        return $this->executors;
    }

    public function setExecutors(Collection $executors): void
    {
        $this->executors = $executors;
    }
}