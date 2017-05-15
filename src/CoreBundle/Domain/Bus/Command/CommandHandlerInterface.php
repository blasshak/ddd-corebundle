<?php

namespace CoreBundle\Domain\Bus\Command;

/**
 * Interface CommandHandlerInterface
 * @package CoreBundle\Domain\Bus\Command
 */
interface CommandHandlerInterface
{
    /**
     * @access public
     * @param CommandInterface $command
     * @return mixed
     */
    public function handle(CommandInterface $command);
}
