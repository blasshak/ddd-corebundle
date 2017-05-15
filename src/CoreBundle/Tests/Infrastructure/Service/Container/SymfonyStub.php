<?php

namespace CoreBundle\Tests\Infrastructure\Service\Container;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class SymfonyStub
 * @package CoreBundle\Tests\Infrastructure\Service\Container
 */
class SymfonyStub implements ContainerInterface
{
    /**
     * @access private
     * @var array
     */
    private $services;

    public function __construct()
    {
        $this->services = array();
    }

    public function set($id, $service)
    {
        $this->services[$id] = $service;
    }

    public function get($id, $invalidBehavior = self::EXCEPTION_ON_INVALID_REFERENCE)
    {
        return $this->services[$id];
    }

    public function has($id)
    {
        if (!isset($this->services[$id])) {
            return false;
        }

        return true;
    }

    public function initialized($id)
    {
    }

    public function getParameter($name)
    {
    }

    public function hasParameter($name)
    {
    }

    public function setParameter($name, $value)
    {
    }
}
