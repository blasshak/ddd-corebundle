<?php

namespace CoreBundle\Domain\Bus\Event;

/**
 * Interface EventProviderInterface
 * @package CoreBundle\Domain\Bus\Event
 */
interface EventProviderInterface
{
    /**
     * @access public
     * @param EventInterface $event
     * @return void
     */
    public function record(EventInterface $event);

    /**
     * Release the pending events
     * @access public
     * @return EventInterface[] $events
     */
    public function release();
}
