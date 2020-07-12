<?php

declare(strict_types=1);

namespace App\Infrastructure\Users\Controllers;

use App\Domain\Users\UserRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends AbstractController
{
    public function index(UserRepositoryInterface $users): JsonResponse
    {
        return $this->json([
            'users' => $users->findAllActiveUsers()
        ]);
    }
}