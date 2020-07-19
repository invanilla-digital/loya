<?php

declare(strict_types=1);

namespace App\Domain\Campaigns;

interface CampaignRepositoryInterface
{
    public function getTotalCount(): int;

    public function findAllCampaigns(): array;

    public function getFindAllCampaignsQuery();

    public function findById(string $uuid): ?Campaign;

    public function create(Campaign $campaign): void;

    public function update(Campaign $campaign): void;

    public function delete(Campaign $campaign): void;
}