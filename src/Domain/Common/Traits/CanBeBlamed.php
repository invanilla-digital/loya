<?php

declare(strict_types=1);

namespace App\Domain\Common\Traits;

use App\Domain\Users\User;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait CanBeBlamed
{
    /**
     * @Gedmo\Blameable(on="create")
     * @ORM\ManyToOne(targetEntity="App\Domain\Users\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected ?User $createdBy;

    /**
     * @Gedmo\Blameable(on="update")
     * @ORM\ManyToOne(targetEntity="App\Domain\Users\User")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected ?User $updatedBy;

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function getUpdatedBy(): ?User
    {
        return $this->updatedBy;
    }
}