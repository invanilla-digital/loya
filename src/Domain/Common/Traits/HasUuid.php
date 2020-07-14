<?php

declare(strict_types=1);

namespace App\Domain\Common\Traits;

use Ramsey\Uuid\UuidInterface;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

trait HasUuid
{
    /**
     * @var UuidInterface
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    protected ?UuidInterface $id;

    public function getId(): ?UuidInterface
    {
        return $this->id;
    }
}