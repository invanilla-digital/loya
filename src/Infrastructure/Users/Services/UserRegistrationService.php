<?php

declare(strict_types=1);

namespace App\Infrastructure\Users\Services;

use App\Application\Users\UserRegistrationServiceInterface;
use App\Domain\Users\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserRegistrationService implements UserRegistrationServiceInterface
{
    private EntityManagerInterface $entityManager;
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function register(User $user): bool
    {
        $user->setPassword(
            $this->passwordEncoder->encodePassword($user, $user->getPlainPassword())
        );

        $user->eraseCredentials();

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return true;
    }
}