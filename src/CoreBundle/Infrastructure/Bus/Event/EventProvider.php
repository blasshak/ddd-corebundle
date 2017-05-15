<?php

namespace CoreBundle\Infrastructure\Bus\Event;

use CoreBundle\Domain\Bus\Event\EventInterface;
use CoreBundle\Domain\Bus\Event\EventProviderInterface;

/**
 * Class EventBus
 * @package CoreBundle\Infrastructure\Bus\Event
 */
class EventProvider implements EventProviderInterface
{
    /**
     * @access private
     * @var EventInterface[] $events
     */
    private $events;

    /**
     * @access public
     */
    public function __construct()
    {
        $this->events = array();
    }

    /**
     * @access public
     * @param EventInterface $event
     * @return void
     */
    public function record(EventInterface $event)
    {
        $this->events[$event->name()] = $event;
    }

    /**
     * Release the pending events
     * @access public
     * @return EventInterface[] $events
     */
    public function release()
    {
        $events = $this->events;

        $this->removeEvents();

        return $events;
    }

    /**
     * @access private
     * @return void
     */
    private function removeEvents()
    {
        $this->events = [];
    }
}
