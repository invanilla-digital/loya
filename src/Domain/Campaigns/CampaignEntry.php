<?php

declare(strict_types=1);

namespace App\Domain\Campaigns;

use App\Domain\Campaigns\Traits\HasCampaign;
use App\Domain\Common\Traits\CanBeBlamed;
use App\Domain\Common\Traits\HasTimestamps;
use App\Domain\Common\Traits\HasUuid;
use App\Domain\Customers\Traits\HasConsent;
use App\Domain\Customers\Traits\HasCustomer;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CampaignEntry
 * @package App\Domain\Campaigns
 * @ORM\Entity()
 * @ORM\Table(name="campaign_entries")
 * @ORM\HasLifecycleCallbacks()
 *
 * Campaign entries signify customer participation in campaign.
 * Each campaign entry must have a consent based on what customer has legally agreed to participate.
 * ex. John Doe entered "Black Friday" campaign on 2020/01/02 with active consent for "Marketing Campaigns"
 */
class CampaignEntry
{
    use HasUuid;
    use HasTimestamps;
    use CanBeBlamed;
    use HasCustomer;
    use HasConsent;
    use HasCampaign;

    /**
     * @var Campaign|null
     * @ORM\ManyToOne(targetEntity="App\Domain\Campaigns\Campaign", inversedBy="entries")
     */
    protected ?Campaign $campaign;
}
