<?php

namespace CoreBundle\Tests\Infrastructure\Bus\Event;

use CoreBundle\Domain\Bus\Event\EventBusInterface;
use CoreBundle\Infrastructure\Bus\Event\EventBus;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class EventBusTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_bus
 * @group core_bundle_infrastructure_bus_event
 * @package CoreBundle\Tests\Infrastructure\Bus\Event\EventBusTest
 */
class EventBusTest extends TestCase
{
    /**
     * @access private
     * @var EventBusInterface
     */
    private $eventBus;

    public function setUp()
    {
        $this->eventBus = new EventBus();
    }

    public function test_should_not_handle_event()
    {
        $num = 1;
        $expected = 1;
        $listener = new ListenerStub($num);
        $this->eventBus->addListener('aa', $listener);
        $event = new EventStub();

        $this->eventBus->handle($event);

        $this->assertEquals(1, $num);
    }

    public function test_should_handle_event()
    {
        $num = 1;
        $expected = 2;
        $listener = new ListenerStub($num);
        $this->eventBus->addListener(EventStub::NAME, $listener);
        $event = new EventStub();

        $this->eventBus->handle($event);

        $this->assertEquals($expected, $num);
    }
}
