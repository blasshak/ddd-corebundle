<?php

namespace CoreBundle\Tests\Infrastructure\Service\Inflector;

use CoreBundle\Infrastructure\Service\FormatConverter\FormatConverterInterface;
use CoreBundle\Infrastructure\Service\FormatConverter\JsonFormat;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class JsonFormatTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_services
 * @group core_bundle_infrastructure_services_format_converter
 * @group unit_test
 * @package CoreBundle\Tests\Infrastructure\Service\Inflector
 */
class JsonFormatTest extends KernelTestCase
{
    /**
     * @access private
     * @var FormatConverterInterface
     */
    private $formatConverter;

    public function setUp()
    {
        $this->formatConverter = new JsonFormat();
    }

    public function test_should_convert_array_to_json()
    {
        $array = ['a' => 'b'];

        $newValue = $this->formatConverter->convert($array);

        $this->assertEquals('{"a":"b"}', $newValue);
    }
}
