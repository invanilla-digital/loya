<?php

declare(strict_types=1);

namespace App\Domain\Customers;

interface CustomerRepositoryInterface
{
    public function findAllCustomers(): array;

    public function getFindAllCustomersQuery();

    public function findById(string $uuid): ?Customer;

    public function create(Customer $customer): void;

    public function update(Customer $customer): void;

    public function delete(Customer $customer): void;
}