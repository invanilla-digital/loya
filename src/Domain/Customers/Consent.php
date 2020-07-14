<?php

declare(strict_types=1);

namespace App\Domain\Customers;

use App\Domain\Common\Traits\HasTimestamps;
use App\Domain\Common\Traits\HasUuid;
use App\Domain\Customers\Traits\HasCustomer;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="customer_consents")
 * @ORM\HasLifecycleCallbacks()
 */
class Consent
{
    public const TYPE_MARKETING = 'marketing';
    public const TYPE_DATA_STORAGE = 'data';
    public const TYPE_TERMS_AND_CONDITIONS = 'tos';

    use HasUuid;
    use HasTimestamps;
    use HasCustomer;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected string $type = '';

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="date_immutable", name="expiry_date")
     */
    protected ?DateTimeInterface $expires;
}