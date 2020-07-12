<?php

declare(strict_types=1);

namespace App\Infrastructure\Dashboard\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    public function index()
    {
        return $this->render('dashboard/index.html.twig');
    }
}