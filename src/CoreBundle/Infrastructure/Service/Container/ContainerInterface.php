<?php

namespace CoreBundle\Infrastructure\Service\Container;

/**
 * Interface ContainerInterface
 * @package CoreBundle\Infrastructure\Service\Container
 */
interface ContainerInterface
{
    /**
     * @access public
     * @param string $name
     * @return mixed
     */
    public function getService($name);
}
