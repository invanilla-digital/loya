<?php

declare(strict_types=1);

namespace App\Domain\Campaigns;

use App\Domain\Common\Traits\CanBeBlamed;
use App\Domain\Common\Traits\HasTimestamps;
use App\Domain\Common\Traits\HasUuid;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Campaign
 * @ORM\Entity()
 * @ORM\Table(name="campaigns")
 * @ORM\HasLifecycleCallbacks()
 *
 * Campaigns contain a collection of customer entries in some time period.
 * They are mostly used to group data for easier processing
 * ex. "Black Friday sale" campaign will only contain data from the black friday date.
 */
class Campaign
{
    use HasUuid;
    use HasTimestamps;
    use CanBeBlamed;

    /**
     * @var string|null
     * @ORM\Column(type="string")
     */
    protected ?string $title = null;

    /**
     * @var string|null
     * @ORM\Column(type="text")
     */
    protected ?string $description = null;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(type="datetime_immutable")
     */
    protected ?DateTimeInterface $startDate = null;

    /**
     * @var DateTimeInterface|null
     * @ORM\Column(type="datetime_immutable")
     */
    protected ?DateTimeInterface $endDate = null;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="App\Domain\Campaigns\CampaignEntry", mappedBy="campaign")
     */
    protected Collection $entries;

    public function __construct()
    {
        $this->entries = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getStartDate(): ?DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEntries(): Collection
    {
        return $this->entries;
    }

    public function setEntries(Collection $entries): void
    {
        $this->entries = $entries;
    }
}