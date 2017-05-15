<?php

namespace CoreBundle\Domain\Bus\Event;

/**
 * Interface EventBusInterface
 * @package CoreBundle\Domain\Bus\Event
 */
interface EventBusInterface
{
    /**
     * @access public
     * @param string $eventName
     * @param ListenerInterface $listener
     * @return void
     */
    public function addListener($eventName, ListenerInterface $listener);

    /**
     * @access public
     * @param EventInterface $event
     * @return void
     */
    public function handle(EventInterface $event);
}
