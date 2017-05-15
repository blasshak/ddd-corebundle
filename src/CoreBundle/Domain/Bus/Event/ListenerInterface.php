<?php

namespace CoreBundle\Domain\Bus\Event;

/**
 * Interface ListenerInterface
 * @package CoreBundle\Domain\Bus\Event
 */
interface ListenerInterface
{
    /**
     * @access public
     * @param EventInterface $event
     * @return void
     */
    public function handle(EventInterface $event);
}
