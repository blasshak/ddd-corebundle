<?php

namespace CoreBundle\Infrastructure\Service\Container;

use Symfony\Component\DependencyInjection\ContainerInterface as Container;

/**
 * Class Symfony
 * @package CoreBundle\Infrastructure\Service\Container
 */
class Symfony implements ContainerInterface
{
    /**
     * @access private
     * @var Container
     */
    private $container;

    /**
     * @access public
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @access public
     * @param string $name
     * @return mixed
     * @throws InvalidServiceException
     */
    public function getService($name)
    {
        if (!$this->container->has($name)) {
            throw InvalidServiceException::fromServiceName($name);
        }

        return $this->container->get($name);
    }
}
