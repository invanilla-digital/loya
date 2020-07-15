<?php

declare(strict_types=1);

namespace App\Application\Users;

use App\Domain\Users\User;

interface UserRegistrationServiceInterface
{
    public function register(User $user): bool;
}