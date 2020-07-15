<?php

declare(strict_types=1);

namespace App\Infrastructure\Navigation\Factories;

use App\Application\Navigation\NavigationFactoryInterface;
use App\Domain\Navigation\MenuItem;
use App\Domain\Navigation\NavigationSection;

class NavigationFactory implements NavigationFactoryInterface
{
    /**
     * @param array $config
     * @return NavigationSection[]
     */
    public function make(array $config): array
    {
        $sections = [];

        foreach ($config as $sectionConfig) {
            $sections[] = $this->makeSection($sectionConfig);
        }

        return $sections;
    }

    protected function makeSection(array $config): NavigationSection
    {
        $section = new NavigationSection($config['title']);

        $section->setRoles($config['roles'] ?? []);

        $section->setItems(
            array_map([$this, 'makeItem'], $config['items'] ?? [])
        );

        return $section;
    }

    protected function makeItem(array $config): MenuItem
    {
        $item = new MenuItem();

        $item->setTitle($config['title']);
        $item->setRoles($config['roles'] ?? []);
        $item->setRoute($config['route'] ?? '#');
        $item->setItems(
            array_map([$this, 'makeItem'], $config['items'] ?? [])
        );

        return $item;
    }
}