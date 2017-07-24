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
        if (is_array($data)) {
            return json_encode($data);
        }

        return json_decode($data, true);
    }
}
