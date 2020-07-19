<?php

declare(strict_types=1);

namespace App\Domain\Customers\Traits;

use App\Domain\Customers\Consent;
use Doctrine\ORM\Mapping as ORM;

trait HasConsent
{
    /**
     * @var Consent|null
     * @ORM\OneToOne(targetEntity="App\Domain\Customers\Consent")
     */
    protected ?Consent $consent;

    public function getConsent(): ?Consent
    {
        return $this->consent;
    }

    public function setConsent(?Consent $consent): void
    {
        $this->consent = $consent;
    }
}