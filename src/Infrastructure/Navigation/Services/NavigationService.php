<?php

declare(strict_types=1);

namespace App\Infrastructure\Navigation\Services;

use App\Application\Navigation\NavigationFactoryInterface;
use App\Application\Navigation\NavigationServiceInterface;
use App\Domain\Navigation\RoleBasedAccessibilityInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Security\Core\Security;

class NavigationService implements NavigationServiceInterface
{
    protected const MENU_SECTIONS_CONFIG_KEY = 'services.navigation';

    protected ContainerBagInterface $params;
    protected NavigationFactoryInterface $factory;
    protected Security $security;

    public function __construct(
        ContainerBagInterface $params,
        NavigationFactoryInterface $factory,
        Security $security
    ) {
        $this->params = $params;
        $this->factory = $factory;
        $this->security = $security;
    }

    public function getMenuSections(): array
    {
        return $this->factory->make(require __DIR__ . '/../../../../config/navigation.php');
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
}