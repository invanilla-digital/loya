<?php

namespace App\Infrastructure\Customers\Persistence;

use App\Domain\Customers\Customer;
use App\Domain\Customers\CustomerRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository implements CustomerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    public function findById(string $uuid): ?Customer
    {
        return $this->find($uuid);
    }

    public function delete(Customer $customer): void
    {
        $entities = $this->getEntityManager();

        $entities->remove($customer);
        $entities->flush($customer);
    }

    public function update(Customer $customer): void
    {
        $this->getEntityManager()->flush($customer);
    }

    public function findAllCustomers(): array
    {
        return $this->findAll();
    }

    public function getFindAllCustomersQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('customer');
    }

    public function create(Customer $customer): void
    {
        $entities = $this->getEntityManager();

        $entities->persist($customer);
        $entities->flush($customer);
    }

    public function getTotalCount(): int
    {
        return $this->count([]);
    }
}
