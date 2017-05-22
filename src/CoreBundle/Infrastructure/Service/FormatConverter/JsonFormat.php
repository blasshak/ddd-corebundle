<?php

namespace CoreBundle\Infrastructure\Service\FormatConverter;

/**
 * Class JsonFormat
 * @package CoreBundle\Infrastructure\Service\FormatConverter
 */
class JsonFormat implements FormatConverterInterface
{
    /**
     * @access public
     * @param array $data
     * @return string
     */
    public function convert($data)
    {
        return json_encode($data);
    }
}
