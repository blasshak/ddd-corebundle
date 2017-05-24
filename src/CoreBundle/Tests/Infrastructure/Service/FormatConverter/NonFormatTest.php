<?php

namespace CoreBundle\Tests\Infrastructure\Service\Inflector;

use CoreBundle\Infrastructure\Service\FormatConverter\FormatConverterInterface;
use CoreBundle\Infrastructure\Service\FormatConverter\NonFormat;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class NonFormatTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_services
 * @group core_bundle_infrastructure_services_format_converter
 * @group unit_test
 * @package CoreBundle\Tests\Infrastructure\Service\Inflector
 */
class NonFormatTest extends KernelTestCase
{
    /**
     * @access private
     * @var FormatConverterInterface
     */
    private $formatConverter;

    public function setUp()
    {
        $this->formatConverter = new NonFormat();
    }

    public function test_should_be_array()
    {
        $array = ['a' => 'b'];

        $newValue = $this->formatConverter->convert($array);

        $this->assertEquals($array, $newValue);
    }
}
