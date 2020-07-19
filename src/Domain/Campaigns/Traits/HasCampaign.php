<?php

declare(strict_types=1);

namespace App\Domain\Campaigns\Traits;

use App\Domain\Campaigns\Campaign;
use Doctrine\ORM\Mapping as ORM;

trait HasCampaign
{
    /**
     * @var Campaign|null
     * @ORM\ManyToOne(targetEntity="App\Domain\Campaigns\Campaign")
     */
    protected ?Campaign $campaign;

    public function getCampaign(): ?Campaign
    {
        return $this->campaign;
    }

    public function setCampaign(?Campaign $campaign): void
    {
        $this->campaign = $campaign;
    }
}