<?php

declare(strict_types=1);

namespace App\Infrastructure\Navigation\Controllers;

use App\Application\Navigation\NavigationServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class NavigationController extends AbstractController
{
    protected NavigationServiceInterface $service;

    public function __construct(NavigationServiceInterface $service)
    {
        $this->service = $service;
    }

    public function sidebar(): Response
    {
        return $this->render(
            'layouts/partials/sidebar_navigation.html.twig',
            [
                'sections' => $this->service->getSidebarSections()
            ]
        );
    }

    public function top(): Response
    {
        return $this->render(
            'layouts/partials/top_navigation.html.twig',
            [
                'sections' => $this->service->getTopNavigationSections()
            ]
        );
    }
}