<?php

namespace CoreBundle\Infrastructure\Symfony\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class CoreBundleExtension
 * @package CoreBundle\Infrastructure\Symfony\DependencyInjection
 */
class CoreBundleExtension extends Extension
{
    /**
     * {@inheritDoc}
     * @access publics
     * @param array $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('application_services.yml');
        $loader->load('infrastructure_services.yml');
    }
}
