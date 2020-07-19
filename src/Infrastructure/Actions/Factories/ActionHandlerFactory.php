<?php

declare(strict_types=1);

namespace App\Infrastructure\Actions\Factories;

use App\Application\Actions\ActionHandlerFactoryInterface;
use App\Application\Actions\ActionHandlerInterface;
use App\Domain\Actions\ActionRequestInterface;
use App\Infrastructure\Actions\Exceptions\InvalidActionTypeException;
use App\Infrastructure\Actions\Handlers\RoleChangeActionHandler;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ActionHandlerFactory implements ActionHandlerFactoryInterface
{
    protected const TYPE_HANDLERS = [
        ActionRequestInterface::TYPE_ROLE_CHANGE => RoleChangeActionHandler::class
    ];

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $type
     * @return ActionHandlerInterface&object
     */
    public function make(string $type): ActionHandlerInterface
    {
        if (!isset(static::TYPE_HANDLERS[$type])) {
            InvalidActionTypeException::throw($type . ' is not a valid action request type');
        }

        return $this->container->get(static::TYPE_HANDLERS[$type]);
    }
}