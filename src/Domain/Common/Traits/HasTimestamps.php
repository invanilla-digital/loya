<?php

declare(strict_types=1);

namespace App\Domain\Common\Traits;

use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Adds timestamp fields to entity
 * Entities using this trait MUST have annotation below
 *
 * @ORM\HasLifecycleCallbacks()
 */
trait HasTimestamps
{
    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="datetime_immutable", name="created_at", options={"default": "CURRENT_TIMESTAMP" })
     */
    protected ?DateTimeInterface $createdAt = null;

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="datetime_immutable", name="updated_at", nullable=true)
     */
    protected ?DateTimeInterface $updatedAt = null;

    protected function setUpdatedAt(?DateTimeInterface $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    protected function setCreatedAt(?DateTimeInterface $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function refreshTimestamps(): void
    {
        $this->setUpdatedAt(new DateTimeImmutable('now'));

        if (!$this->getCreatedAt()) {
            $this->setCreatedAt(new DateTimeImmutable('now'));
        }
    }
}