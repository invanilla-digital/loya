<?php

declare(strict_types=1);

namespace App\Domain\Customers\Traits;

use App\Domain\Customers\Customer;
use Doctrine\ORM\Mapping as ORM;

trait HasCustomer
{
    /**
     * @var Customer|null
     *
     * @ORM\ManyToOne(targetEntity="\App\Domain\Customers\Customer")
     */
    protected ?Customer $customer;

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): void
    {
        $this->customer = $customer;
    }
}