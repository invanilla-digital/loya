<?php

declare(strict_types=1);

namespace App\Infrastructure\Navigation\Controllers;

use App\Application\Navigation\NavigationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NavigationController extends AbstractController
{
    public function html(NavigationServiceInterface $service)
    {
        return $this->render('layouts/partials/sidebar_navigation.html.twig', [
            'sections' => $service->getMenuSections()
        ]);
    }
}