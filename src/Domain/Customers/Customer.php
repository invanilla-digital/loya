<?php

declare(strict_types=1);

namespace App\Domain\Customers;

use App\Domain\Common\Traits\HasTimestamps;
use App\Domain\Common\Traits\HasUuid;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="customers")
 * @ORM\HasLifecycleCallbacks()
 */
class Customer
{
    use HasUuid;
    use HasTimestamps;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="name")
     */
    protected string $name = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="surname")
     */
    protected string $surname = '';


    /**
     * @var string
     *
     * @ORM\Column(type="string", name="personal_code")
     */
    protected string $personalCode = '';

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="email")
     */
    protected string $email = '';

    /**
     * @var DateTimeInterface|null
     *
     * @ORM\Column(type="date_immutable")
     */
    protected ?DateTimeInterface $dateOfBirth;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="\App\Domain\Customers\Address", mappedBy="customer")
     */
    protected Collection $addresses;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="\App\Domain\Customers\Consent", mappedBy="customer")
     */
    protected Collection $consents;

    public function __construct()
    {
        $this->addresses = new ArrayCollection();
        $this->consents = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Customer
     */
    public function setName(string $name): Customer
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     * @return Customer
     */
    public function setSurname(string $surname): Customer
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @return string
     */
    public function getPersonalCode(): string
    {
        return $this->personalCode;
    }

    /**
     * @param string $personalCode
     * @return Customer
     */
    public function setPersonalCode(string $personalCode): Customer
    {
        $this->personalCode = $personalCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Customer
     */
    public function setEmail(string $email): Customer
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return DateTimeInterface|null
     */
    public function getDateOfBirth(): ?DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    /**
     * @param DateTimeInterface|null $dateOfBirth
     * @return Customer
     */
    public function setDateOfBirth(?DateTimeInterface $dateOfBirth): Customer
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    /**
     * @param Collection $addresses
     * @return Customer
     */
    public function setAddresses(Collection $addresses): Customer
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getConsents(): Collection
    {
        return $this->consents;
    }

    /**
     * @param Collection $consents
     * @return Customer
     */
    public function setConsents(Collection $consents): Customer
    {
        $this->consents = $consents;

        return $this;
    }
}