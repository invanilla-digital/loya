<?php

declare(strict_types=1);

namespace App\Domain\Users;

interface UserRepositoryInterface
{
    public function getTotalCount(): int;

    public function findById(int $id): ?User;

    public function findAllActiveUsers(): iterable;

    public function getAllUsersQuery();

    public function delete(User $user): void;

    public function update(User $user): void;
}