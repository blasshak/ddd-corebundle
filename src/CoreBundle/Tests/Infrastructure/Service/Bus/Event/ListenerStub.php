<?php

namespace CoreBundle\Tests\Infrastructure\Service\Bus\Event;

use CoreBundle\Domain\Bus\Event\EventInterface;
use CoreBundle\Domain\Bus\Event\ListenerInterface;

/**
 * Class ListenerStub
 * @package CoreBundle\Tests\Infrastructure\Service\Bus\Event
 */
class ListenerStub implements ListenerInterface
{
    /**
     * @access private
     * @var int
     */
    private $num;

    /**
     * @param int $num
     */
    public function __construct(&$num)
    {
        $this->num = &$num;
    }

    /**
     * @access public
     * @param EventInterface $event
     * @return void
     */
    public function handle(EventInterface $event)
    {
        $this->num++;
    }
}
