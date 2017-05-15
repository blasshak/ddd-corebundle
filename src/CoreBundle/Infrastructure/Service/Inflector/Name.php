<?php

namespace CoreBundle\Infrastructure\Service\Inflector;

use CoreBundle\Domain\Bus\Command\CommandInterface;

/**
 * Class Name
 * @package CoreBundle\Infrastructure\Service\Inflector
 */
class Name implements InflectorInterface
{
    /**
     * @access public
     * @param CommandInterface $command
     * @return string
     */
    public function inflect(CommandInterface $command) : string
    {
        $str = (new \ReflectionClass($command))->getShortName();
        $split = preg_split('/(?<=\\w)(?=[A-Z])/', $str);
        array_push($split, 'handler');
        $name = strtolower(implode('_', $split));

        return $name;
    }
}
