<?php

declare(strict_types=1);

namespace App\Domain\Campaigns;

use App\Domain\Common\Traits\CanBeBlamed;
use App\Domain\Common\Traits\HasTimestamps;
use App\Domain\Common\Traits\HasUuid;
use DateTimeInterface;
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
}