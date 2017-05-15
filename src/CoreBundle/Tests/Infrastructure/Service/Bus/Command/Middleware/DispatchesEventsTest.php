<?php

namespace CoreBundle\Tests\Infrastructure\Service\Bus\Command\Middleware;

use CoreBundle\Domain\Bus\Command\CommandInterface;
use CoreBundle\Domain\Bus\Event\EventBusInterface;
use CoreBundle\Domain\Bus\Event\EventInterface;
use CoreBundle\Domain\Bus\Event\EventProviderInterface;
use CoreBundle\Infrastructure\Bus\Command\Middleware\DispatchesEvents;
use CoreBundle\Infrastructure\Bus\Command\Middleware\MiddlewareInterface;
use CoreBundle\Infrastructure\Bus\Event\EventBus;
use CoreBundle\Infrastructure\Bus\Event\EventProvider;
use CoreBundle\Infrastructure\Service\Container\InvalidServiceException;
use CoreBundle\Tests\Infrastructure\Service\Bus\Command\CounterCommandStub;
use CoreBundle\Tests\Infrastructure\Service\Bus\Event\EventStub;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use \Mockery as m;

/**
 * Class DispatchesEventsTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_services
 * @group core_bundle_infrastructure_services_bus_command_middleware
 * @package CoreBundle\Tests\Infrastructure\Service\Bus\Command\Middleware
 */
class DispatchesEventsTest extends TestCase
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

    /**
     * @access private
     * @var EventBusInterface
     */
    private $eventBus;

    /**
     * @access private
     * @var CommandInterface
     */
    private $command;

    /**
     * @access private
     * @var callable
     */
    private $lastCallable;

    public function setUp()
    {
        $this->eventProvider = new EventProvider();
        $this->eventStub = new EventStub();
        $this->eventBus = new EventBus();
        $this->command = new CounterCommandStub(1);
        $this->lastCallable = function () {
            return 1;
        };
    }

    public function test_should_execute_invalid_service_exception()
    {
        $this->eventProvider->record($this->eventStub);
        $middleware = $this->createMiddleware(true);
        $eventMiddleware = new DispatchesEvents($this->eventBus, $this->eventProvider);
        $command = $this->command;
        $callable = $this->lastCallable;

        $this->expectException(InvalidServiceException::class);

        $eventMiddleware->execute($command, function () use ($middleware, $command, $callable) {
            $middleware->execute($command, $callable);
        });
    }

    public function test_should_executed_successfully()
    {
        $this->eventProvider->record($this->eventStub);
        $eventMiddleware = new DispatchesEvents($this->eventBus, $this->eventProvider);

        $num = $eventMiddleware->execute($this->command, $this->lastCallable);

        $this->assertEquals(1, $num);
        $this->assertCount(0, $this->eventProvider->release());
    }

    private function createMiddleware($exception)
    {
        $middleware = m::mock(MiddlewareInterface::class);

        if ($exception) {
            $middleware->shouldReceive('execute')->andThrowExceptions(array(new InvalidServiceException()));
        } else {
            $middleware->shouldReceive('execute')->andReturnNull();
        }

        return $middleware;
    }
}
