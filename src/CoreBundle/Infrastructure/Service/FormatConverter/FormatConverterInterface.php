<?php

namespace CoreBundle\Infrastructure\Service\FormatConverter;

/**
 * Interface FormatConverterInterface
 * @package CoreBundle\Infrastructure\Service\FormatConverter
 */
interface FormatConverterInterface
{
    /**
     * @access public
     * @param array $data
     * @return mixed
     */
    public function convert($data);
}
