<?php

namespace CoreBundle\Tests\Infrastructure\Service\Inflector;

use CoreBundle\Infrastructure\Service\Inflector\InflectorInterface;
use CoreBundle\Infrastructure\Service\Inflector\CommandHandlerName;
use CoreBundle\Tests\Infrastructure\Service\Bus\Command\DummyCommand;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class CommandHandlerNameTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_services
 * @group core_bundle_infrastructure_services_inflector
 * @package CoreBundle\Tests\Infrastructure\Service\Inflector
 */
class CommandHandlerNameTest extends KernelTestCase
{
    /**
     * @access private
     * @var InflectorInterface
     */
    private $inflector;

    public function setUp()
    {
        $this->inflector = new CommandHandlerName();
    }

    public function test_should_get_handler_name_from_command()
    {
        $command = new DummyCommand();

        $name = $this->inflector->inflect($command);

        $this->assertEquals('cb.infrastructure.dummy_command_handler', $name);
    }
}
