<?php

declare(strict_types=1);

namespace App\Infrastructure\Dashboard\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * Class DashboardController
 * @package App\Infrastructure\Dashboard\Controllers
 *
 * @IsGranted("ROLE_USER")
 */
class DashboardController extends AbstractController
{
    public function index()
    {
        return $this->render('dashboard/index.html.twig');
    }
}