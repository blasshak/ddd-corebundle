<?php

namespace CoreBundle\Infrastructure\Service\Inflector;

use CoreBundle\Domain\Bus\Command\CommandInterface;

/**
 * Interface InflectorInterface
 * @package CoreBundle\Infrastructure\Service\Inflector
 */
interface InflectorInterface
{
    /**
     * @access public
     * @param CommandInterface $command
     * @return string
     */
    public function inflect(CommandInterface $command) : string;
}
