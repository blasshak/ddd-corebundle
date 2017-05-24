<?php

namespace CoreBundle\Tests\Infrastructure\Service\Container;

use CoreBundle\Infrastructure\Service\Container\ContainerInterface;
use CoreBundle\Infrastructure\Service\Container\InvalidServiceException;
use CoreBundle\Infrastructure\Service\Container\Symfony;
use CoreBundle\Infrastructure\Service\Inflector\InflectorInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class SymfonyTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_services
 * @group core_bundle_infrastructure_services_container
 * @group unit_test
 * @package CoreBundle\Tests\Infrastructure\Service\Container
 */
class SymfonyTest extends KernelTestCase
{
    /**
     * @access private
     * @var ContainerInterface
     */
    private $container;

    public function setUp()
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();

        $this->container = new Symfony($container);
    }

    public function test_should_not_get_service_from_container()
    {
        $this->expectException(InvalidServiceException::class);

        $this->container->getService('inflector_namess');
    }

    public function test_should_get_service_from_container()
    {
        $service = $this->container->getService('cb.infrastructure.inflector_command_handler_name');

        $this->assertInstanceOf(InflectorInterface::class, $service);
    }
}
