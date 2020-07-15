<?php

declare(strict_types=1);

namespace App\Infrastructure\Navigation\Services;

use App\Application\Navigation\NavigationFactoryInterface;
use App\Application\Navigation\NavigationServiceInterface;
use App\Domain\Navigation\RoleBasedAccessibilityInterface;
use App\Domain\Navigation\RouteAwareInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class NavigationService implements NavigationServiceInterface
{
    protected const MENU_SECTIONS_CONFIG_KEY = 'services.navigation';

    protected ContainerBagInterface $params;
    protected NavigationFactoryInterface $factory;
    protected Security $security;
    protected RequestStack $requests;

    public function __construct(
        ContainerBagInterface $params,
        NavigationFactoryInterface $factory,
        Security $security,
        RequestStack $requests
    ) {
        $this->params = $params;
        $this->factory = $factory;
        $this->security = $security;
        $this->requests = $requests;
    }

    public function getSidebarSections(): array
    {
        return $this->factory->make(require __DIR__ . '/../../../../config/sidebar_navigation.php');
    }

    public function isItemAccessible(RoleBasedAccessibilityInterface $item): bool
    {
        if (!$item->getRoles()) {
            return true;
        }

        $user = $this->security->getUser();

        if (!$user) {
            return false;
        }

        foreach ($user->getRoles() as $role) {
            if ($item->isAccessibleByRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function getTopNavigationSections(): array
    {
        return $this->factory->make(require __DIR__ . '/../../../../config/top_navigation.php');
    }

    public function isItemActive(RouteAwareInterface $item): bool
    {
        $request = $this->requests->getMasterRequest();

        if (!$request) {
            return false;
        }

        return $request->attributes->get('_route') === $item->getRoute();
    }
}