<?php

namespace CoreBundle\Application\DataTransformer;

/**
 * Interface DataTransformerInterface
 * @package CoreBundle\Application\DataTransformer
 */
interface DataTransformerInterface
{
    /**
     * @access public
     * @return mixed
     */
    public function transform();
}
