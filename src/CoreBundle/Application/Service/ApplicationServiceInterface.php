<?php

namespace CoreBundle\Application\Service;

/**
 * Interface ApplicationServiceInterface
 * @package CoreBundle\Application\Service
 */
interface ApplicationServiceInterface
{
    /**
     * @access public
     * @param array $request
     * @return array
     */
    public function execute(array $request);
}
