<?php

namespace CoreBundle\Tests\Infrastructure\Bus\Event;

use CoreBundle\Domain\Bus\Event\EventInterface;

/**
 * Class EventStub
 * @package CoreBundle\Tests\Infrastructure\Bus\Event
 */
class EventStub implements EventInterface
{
    const NAME = 'event_stub';

    /**
     * @access public
     * @return string
     */
    public function name() : string
    {
        return self::NAME;
    }
}
