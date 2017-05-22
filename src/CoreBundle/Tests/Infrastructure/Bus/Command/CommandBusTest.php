<?php

namespace CoreBundle\Tests\Infrastructure\Bus\Command;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class CommandBusTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @package CoreBundle\Tests\Infrastructure\Bus\Command
 */
class CommandBusTest extends TestCase
{
    public function test_add_middlewares_at_first_position()
    {
        $commandBus = $this->createCommandBus(array('b'));

        $commandBus->addMiddlewares(array('0' => 'a'));

        $this->assertEquals(array('a', 'b'), $commandBus->getMiddlewares());
    }

    public function test_add_middlewares_at_last_position()
    {
        $commandBus = $this->createCommandBus(array('a'));

        $commandBus->addMiddlewares(array('1' => 'b'));

        $this->assertEquals(array('a', 'b'), $commandBus->getMiddlewares());
    }

    public function test_add_middlewares_in_the_middle_position()
    {
        $commandBus = $this->createCommandBus(array('a', 'c'));

        $commandBus->addMiddlewares(array('1' => 'b'));

        $this->assertEquals(array('a', 'b', 'c'), $commandBus->getMiddlewares());
    }

    /**
     * @access private
     * @return CommandBusStub
     */
    private function createCommandBus($middlewares)
    {
        $commandBus = new CommandBusStub($middlewares);

        return $commandBus;
    }
}
