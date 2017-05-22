<?php

namespace CoreBundle\Infrastructure\Service\FormatConverter;

/**
 * Class NonFormat
 * @package CoreBundle\Infrastructure\Service\FormatConverter
 */
class NonFormat implements FormatConverterInterface
{
    /**
     * @access public
     * @param array $data
     * @return array
     */
    public function convert($data)
    {
        return $data;
    }
}
