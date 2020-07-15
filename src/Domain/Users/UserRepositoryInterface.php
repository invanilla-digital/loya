<?php

declare(strict_types=1);

namespace App\Domain\Users;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;

    public function findAllActiveUsers(): iterable;

    public function getAllUsersQuery();

    public function delete(User $user): void;
}