<?php

declare(strict_types=1);

namespace App\Domain\Customers;

use App\Domain\Common\Traits\CanBeBlamed;
use App\Domain\Common\Traits\HasTimestamps;
use App\Domain\Common\Traits\HasUuid;
use App\Domain\Customers\Traits\HasCustomer;
use CommerceGuys\Addressing\AddressInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="customer_addresses")
 * @ORM\HasLifecycleCallbacks()
 */
class Address implements AddressInterface
{
    use HasUuid;
    use HasTimestamps;
    use HasCustomer;
    use CanBeBlamed;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $countryCode;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $administrativeArea;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $locality;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $dependentLocality;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $postalCode;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $sortingCode;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $addressLine1;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $addressLine2;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $organization;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $givenName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $additionalName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $familyName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string")
     */
    protected ?string $locale;

    /**
     * @var Customer|null
     *
     * @ORM\ManyToOne(targetEntity="\App\Domain\Customers\Customer", inversedBy="addresses")
     */
    protected ?Customer $customer;

    /**
     * @param string|null $countryCode
     * @return Address
     */
    public function setCountryCode(?string $countryCode): Address
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * @param string|null $administrativeArea
     * @return Address
     */
    public function setAdministrativeArea(?string $administrativeArea): Address
    {
        $this->administrativeArea = $administrativeArea;

        return $this;
    }

    /**
     * @param string|null $locality
     * @return Address
     */
    public function setLocality(?string $locality): Address
    {
        $this->locality = $locality;

        return $this;
    }

    /**
     * @param string|null $dependentLocality
     * @return Address
     */
    public function setDependentLocality(?string $dependentLocality): Address
    {
        $this->dependentLocality = $dependentLocality;

        return $this;
    }

    /**
     * @param string|null $postalCode
     * @return Address
     */
    public function setPostalCode(?string $postalCode): Address
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @param string|null $sortingCode
     * @return Address
     */
    public function setSortingCode(?string $sortingCode): Address
    {
        $this->sortingCode = $sortingCode;

        return $this;
    }

    /**
     * @param string|null $addressLine1
     * @return Address
     */
    public function setAddressLine1(?string $addressLine1): Address
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * @param string|null $addressLine2
     * @return Address
     */
    public function setAddressLine2(?string $addressLine2): Address
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * @param string|null $organization
     * @return Address
     */
    public function setOrganization(?string $organization): Address
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * @param string|null $givenName
     * @return Address
     */
    public function setGivenName(?string $givenName): Address
    {
        $this->givenName = $givenName;

        return $this;
    }

    /**
     * @param string|null $additionalName
     * @return Address
     */
    public function setAdditionalName(?string $additionalName): Address
    {
        $this->additionalName = $additionalName;

        return $this;
    }

    /**
     * @param string|null $familyName
     * @return Address
     */
    public function setFamilyName(?string $familyName): Address
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * @param string|null $locale
     * @return Address
     */
    public function setLocale(?string $locale): Address
    {
        $this->locale = $locale;

        return $this;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    public function getAdministrativeArea(): ?string
    {
        return $this->administrativeArea;
    }

    public function getLocality(): ?string
    {
        return $this->locality;
    }

    public function getDependentLocality(): ?string
    {
        return $this->dependentLocality;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getSortingCode(): ?string
    {
        return $this->sortingCode;
    }

    public function getAddressLine1(): ?string
    {
        return $this->addressLine1;
    }

    public function getAddressLine2(): ?string
    {
        return $this->addressLine2;
    }

    public function getOrganization(): ?string
    {
        return $this->organization;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function getAdditionalName(): ?string
    {
        return $this->additionalName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }
}