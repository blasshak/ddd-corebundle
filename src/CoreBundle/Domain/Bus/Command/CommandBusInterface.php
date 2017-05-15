<?php

namespace CoreBundle\Domain\Bus\Command;

/**
 * Interface CommandBusInterface
 * @package CoreBundle\Domain\Bus\Command
 */
interface CommandBusInterface
{
    /**
     * @access public
     * @param array $middlewares
     * @return void
     */
    public function preHandle(array $middlewares);

    /**
     * Executes the given command and optionally returns a value
     * @access public
     * @param CommandInterface $command
     * @return mixed
     */
    public function handle(CommandInterface $command);
}
