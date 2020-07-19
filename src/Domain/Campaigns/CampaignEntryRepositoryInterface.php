<?php

declare(strict_types=1);

namespace App\Domain\Campaigns;

interface CampaignEntryRepositoryInterface
{
    public function getTotalCount(): int;

    public function findAllEntries(): array;

    public function getFindAllEntriesQuery();

    public function findById(string $uuid): ?CampaignEntry;

    public function create(CampaignEntry $entry): void;

    public function update(CampaignEntry $entry): void;

    public function delete(CampaignEntry $entry): void;
}