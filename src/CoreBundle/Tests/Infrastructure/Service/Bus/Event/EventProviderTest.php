<?php

namespace CoreBundle\Tests\Infrastructure\Service\Bus\Event;

use CoreBundle\Domain\Bus\Event\EventInterface;
use CoreBundle\Domain\Bus\Event\EventProviderInterface;
use CoreBundle\Infrastructure\Bus\Event\EventProvider;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class EventProviderTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_service
 * @group core_bundle_infrastructure_service_bus
 * @group core_bundle_infrastructure_service_bus_event
 * @package CoreBundle\Tests\Infrastructure\Service\Bus\Event\EventProviderTest
 */
class EventProviderTest extends TestCase
{
    /**
     * @access private
     * @var EventProviderInterface
     */
    private $eventProvider;

    /**
     * @access private
     * @var EventInterface
     */
    private $eventStub;

    public function setUp()
    {
        $this->eventProvider = new EventProvider();
        $this->eventStub = new EventStub();
    }

    public function test_should_record_event()
    {
        $this->eventProvider->record($this->eventStub);

        $events = $this->eventProvider->release();
        $this->assertCount(1, $events);
        $this->assertEquals(EventStub::NAME, $events[EventStub::NAME]->name());
    }

    public function test_should_release_event()
    {
        $this->eventProvider->record($this->eventStub);

        $events = $this->eventProvider->release();

        $this->assertCount(1, $events);
        $this->assertCount(0, $this->eventProvider->release());
    }
}
