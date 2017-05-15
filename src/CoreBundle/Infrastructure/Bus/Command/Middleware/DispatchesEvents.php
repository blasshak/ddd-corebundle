<?php

namespace CoreBundle\Infrastructure\Bus\Command\Middleware;

use CoreBundle\Domain\Bus\Command\CommandInterface;
use CoreBundle\Domain\Bus\Event\EventBusInterface;
use CoreBundle\Domain\Bus\Event\EventProviderInterface;

/**
 * Class DispatchesEvents
 * @package CoreBundle\Infrastructure\Bus\Command\Middleware
 */
class DispatchesEvents implements MiddlewareInterface
{
    /**
     * @access private
     * @var EventBusInterface
     */
    private $eventBus;

    /**
     * @access private
     * @var EventProviderInterface
     */
    private $eventProvider;

    /**
     * @acces public
     * @param EventBusInterface $eventBus
     * @param EventProviderInterface $eventProvider
     */
    public function __construct(EventBusInterface $eventBus, EventProviderInterface $eventProvider)
    {
        $this->eventBus = $eventBus;
        $this->eventProvider = $eventProvider;
    }

    /**
     * @access public
     * @param CommandInterface $command
     * @param callable $next
     * @return mixed
     * @throws \Exception
     */
    public function execute(CommandInterface $command, callable $next)
    {
        try {
            $returnValue = $next($command);
            $events = $this->eventProvider->release();

            foreach ($events as $event) {
                $this->eventBus->handle($event);
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return $returnValue;
    }
}
