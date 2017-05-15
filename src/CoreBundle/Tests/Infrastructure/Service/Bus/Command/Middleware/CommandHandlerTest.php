<?php

namespace CoreBundle\Tests\Infrastructure\Service\Bus\Command\Middleware;

use CoreBundle\Infrastructure\Bus\Command\Middleware\CommandHandler;
use CoreBundle\Infrastructure\Service\Container\InvalidServiceException;
use CoreBundle\Infrastructure\Service\Container\Symfony;
use CoreBundle\Infrastructure\Service\Inflector\Name;
use CoreBundle\Tests\Infrastructure\Service\Bus\Command\CounterCommandHandlerStub;
use CoreBundle\Tests\Infrastructure\Service\Bus\Command\CounterCommandStub;
use CoreBundle\Tests\Infrastructure\Service\Container\SymfonyStub;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class CommandHandlerTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_services
 * @group core_bundle_infrastructure_services_bus_command_middleware
 * @package CoreBundle\Tests\Infrastructure\Service\Bus\Command\Middleware
 */
class CommandHandlerTest extends TestCase
{
    public function test_should_executed_unsuccessfully()
    {
        $containerStub = new SymfonyStub();
        $containerStub->set('counter_command_stub_handlers', new CounterCommandHandlerStub());
        $container = new Symfony($containerStub);
        $inflector = new Name();
        $commandHandler = new CommandHandler($container, $inflector);
        $num = 1;
        $command = new CounterCommandStub($num);
        $lastCallable = function () {
        };

        $this->expectException(InvalidServiceException::class);

        $commandHandler->execute($command, $lastCallable);
    }

    public function test_should_executed_successfully()
    {
        $containerStub = new SymfonyStub();
        $containerStub->set('counter_command_stub_handler', new CounterCommandHandlerStub());
        $container = new Symfony($containerStub);
        $inflector = new Name();
        $commandHandler = new CommandHandler($container, $inflector);
        $num = 1;
        $command = new CounterCommandStub($num);
        $lastCallable = function () {
        };

        $num = $commandHandler->execute($command, $lastCallable);

        $this->assertEquals(2, $num);
    }
}
