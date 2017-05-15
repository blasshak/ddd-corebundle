<?php

namespace CoreBundle\Infrastructure\Bus\Event;

use CoreBundle\Domain\Bus\Event\EventBusInterface;
use CoreBundle\Domain\Bus\Event\EventInterface;
use CoreBundle\Domain\Bus\Event\ListenerInterface;

/**
 * Class EventBus
 * @package CoreBundle\Infrastructure\Bus\Event
 */
class EventBus implements EventBusInterface
{
    /**
     * @access private
     * @var ListenerInterface[] $listeners
     */
    private $listeners;

    /**
     * @access public
     * @param string $eventName
     * @param ListenerInterface $listener
     * @return void
     */
    public function addListener($eventName, ListenerInterface $listener)
    {
        $this->listeners[$eventName][] = $listener;
    }

    /**
     * @access public
     * @param EventInterface $event
     * @return void
     */
    public function handle(EventInterface $event)
    {
        if (isset($this->listeners[$event->name()])) {
            /** @var ListenerInterface[] $listeners */
            $listeners = $this->listeners[$event->name()];

            foreach ($listeners as $listener) {
                $listener->handle($event);
            }
        }
    }
}
