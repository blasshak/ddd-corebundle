<?php

namespace CoreBundle\Application\Service;

use CoreBundle\Domain\Bus\Command\CommandBusInterface;
use CoreBundle\Domain\Bus\Event\EventBusInterface;

/**
 * Class AbstractApplicationService
 * @package CoreBundle\Application\Service
 */
abstract class AbstractApplicationService implements ApplicationServiceInterface
{
    /**
     * @access private
     * @var array
     */
    private $middlewares;

    /**
     * @access protected
     * @var CommandBusInterface
     */
    protected $commandBus;

    /**
     * @access protected
     * @var EventBusInterface
     */
    protected $eventBus;

    /**
     * @access public
     * @param array $middlewares
     */
    public function __construct($middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * @access public
     * @param CommandBusInterface $commandBus
     */
    public function setCommandBus(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
        $this->commandBus->preHandle($this->middlewares);
    }

    /**
     * @access public
     * @param EventBusInterface $eventBus
     */
    public function setEventBus(EventBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    /**
     * @access public
     * @param array $request
     * @return array
     */
    abstract public function execute(array $request);
}
