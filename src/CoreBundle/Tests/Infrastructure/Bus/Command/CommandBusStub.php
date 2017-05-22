<?php

namespace CoreBundle\Tests\Infrastructure\Bus\Command;

use CoreBundle\Infrastructure\Bus\Command\CommandBus;

/**
 * Class CommandBusStub
 * @package CoreBundle\Tests\Infrastructure\Bus\Command
 */
class CommandBusStub extends CommandBus
{
    /**
     * @access public
     * @return array
     */
    public function getMiddlewares() : array
    {
        return $this->middlewares;
    }
}
