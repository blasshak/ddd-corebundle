<?php

namespace CoreBundle\Infrastructure\Symfony;

use CoreBundle\Infrastructure\Symfony\DependencyInjection\CoreBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class CoreBundle
 * @package CoreBundle\Infrastructure\Symfony
 */
class CoreBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new CoreBundleExtension();
    }
}
