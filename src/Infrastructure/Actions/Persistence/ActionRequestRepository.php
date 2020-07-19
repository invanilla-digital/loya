<?php

declare(strict_types=1);

namespace App\Infrastructure\Actions\Persistence;

use App\Domain\Actions\ActionRequest;
use App\Domain\Actions\ActionRequestInterface;
use App\Domain\Actions\ActionRequestRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method ActionRequestInterface|null findOneBy(array $criteria, array $orderBy = null)
 * @method ActionRequestInterface[]    findAll()
 * @method ActionRequestInterface[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActionRequestRepository extends ServiceEntityRepository implements ActionRequestRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ActionRequest::class);
    }

    /**
     * @param string $uuid
     * @param null $lockMode
     * @param null $lockVersion
     * @return ActionRequestInterface&object|null
     */
    public function find($uuid, $lockMode = null, $lockVersion = null): ?ActionRequestInterface
    {
        return parent::find($uuid);
    }

    public function findByExecutor(UserInterface $executor): Collection
    {
        return new ArrayCollection(
            $this->createQueryBuilder('request')
                ->where(':executor IN request.executors')
                ->setParameter('executor', $executor)
                ->getQuery()
                ->getResult()
        );
    }

    public function delete(ActionRequestInterface $request): void
    {
        $entities = $this->getEntityManager();

        $entities->remove($request);
        $entities->flush($request);
    }

    public function update(ActionRequestInterface $request): void
    {
        $this->getEntityManager()->flush($request);
    }

    public function create(ActionRequestInterface $request): void
    {
        $entities = $this->getEntityManager();

        $entities->persist($request);
        $entities->flush($request);
    }
}