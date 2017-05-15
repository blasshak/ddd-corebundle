<?php

namespace CoreBundle\Tests\Infrastructure\Service\Bus\Command;

use CoreBundle\Domain\Bus\Command\CommandHandlerInterface;
use CoreBundle\Domain\Bus\Command\CommandInterface;

/**
 * Class CounterCommandHandlerStub
 * @package CoreBundle\Tests\Infrastructure\Service\Bus\Command
 */
class CounterCommandHandlerStub implements CommandHandlerInterface
{
    /**
     * @access public
     * @param CommandInterface $command
     * @return int
     */
    public function handle(CommandInterface $command)
    {
        $num = $command->num();
        $num++;

        return $num;
    }
}
