<?php

namespace CoreBundle\Tests\Infrastructure\Service\Bus\Command;

use CoreBundle\Domain\Bus\Command\CommandInterface;

/**
 * Class CounterCommandStub
 * @package CoreBundle\Tests\Infrastructure\Service\Bus\Command
 */
class CounterCommandStub implements CommandInterface
{
    /**
     * @access private
     * @var int
     */
    private $num;

    /**
     * @access public
     * @param int $num
     */
    public function __construct($num)
    {
        $this->num = $num;
    }

    /**
     * @access public
     * @return int
     */
    public function num()
    {
        return $this->num;
    }
}
