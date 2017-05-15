<?php

namespace CoreBundle\Domain\Bus\Event;

/**
 * Interface EventInterface
 * @package CoreBundle\Domain\Bus\Event
 */
interface EventInterface
{
    /**
     * @access public
     * @return string
     */
    public function name() : string;
}
