<?php

namespace App\Infrastructure\Campaigns\Persistence;

use App\Domain\Campaigns\CampaignEntry;
use App\Domain\Campaigns\CampaignEntryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CampaignEntry|null find($id, $lockMode = null, $lockVersion = null)
 * @method CampaignEntry|null findOneBy(array $criteria, array $orderBy = null)
 * @method CampaignEntry[]    findAll()
 * @method CampaignEntry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampaignEntryRepository extends ServiceEntityRepository implements CampaignEntryRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CampaignEntry::class);
    }

    public function findById(string $uuid): ?CampaignEntry
    {
        return $this->find($uuid);
    }

    public function delete(CampaignEntry $entry): void
    {
        $entities = $this->getEntityManager();

        $entities->remove($entry);
        $entities->flush($entry);
    }

    public function update(CampaignEntry $entry): void
    {
        $this->getEntityManager()->flush($entry);
    }

    public function findAllEntries(): array
    {
        return $this->findAll();
    }

    public function getFindAllEntriesQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('campaign_entry');
    }

    public function create(CampaignEntry $entry): void
    {
        $entities = $this->getEntityManager();

        $entities->persist($entry);
        $entities->flush($entry);
    }

    public function getTotalCount(): int
    {
        return $this->count([]);
    }
}
