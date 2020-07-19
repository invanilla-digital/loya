<?php

namespace App\Infrastructure\Campaigns\Persistence;

use App\Domain\Campaigns\Campaign;
use App\Domain\Campaigns\CampaignRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Campaign|null find($id, $lockMode = null, $lockVersion = null)
 * @method Campaign|null findOneBy(array $criteria, array $orderBy = null)
 * @method Campaign[]    findAll()
 * @method Campaign[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CampaignRepository extends ServiceEntityRepository implements CampaignRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Campaign::class);
    }

    public function findById(string $uuid): ?Campaign
    {
        return $this->find($uuid);
    }

    public function delete(Campaign $campaign): void
    {
        $entities = $this->getEntityManager();

        $entities->remove($campaign);
        $entities->flush($campaign);
    }

    public function update(Campaign $campaign): void
    {
        $this->getEntityManager()->flush($campaign);
    }

    public function findAllCampaigns(): array
    {
        return $this->findAll();
    }

    public function getFindAllCampaignsQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('campaign');
    }

    public function create(Campaign $campaign): void
    {
        $entities = $this->getEntityManager();

        $entities->persist($campaign);
        $entities->flush($campaign);
    }

    public function getTotalCount(): int
    {
        return $this->count([]);
    }
}
