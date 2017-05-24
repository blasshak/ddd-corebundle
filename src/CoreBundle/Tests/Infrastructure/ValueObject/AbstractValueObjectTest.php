<?php

namespace CoreBundle\Tests\Infrastructure\ValueObject;

use CoreBundle\Infrastructure\ValueObject\AbstractValueObject;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class ValueObjectTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_value_object
 * @group unit_test
 * @package CoreBundle\Tests\Infrastructure\ValueObject
 */
class AbstractValueObjectTest extends TestCase
{
    public function test_should_create_value_object()
    {
        $value = 's';

        $valueObject = ValueObjectStub::create($value);

        $this->assertInstanceOf(AbstractValueObject::class, $valueObject);
        $this->assertEquals($value, $valueObject);
    }

    public function test_should_create_a_new_value_object_from_native()
    {
        $value = 's';
        $valueObject = ValueObjectStub::create($value);

        $valueObject2 = ValueObjectStub::fromNative($valueObject);

        $this->assertFalse($valueObject === $valueObject2);
    }

    public function test_should_not_be_equal()
    {
        $valueObject = ValueObjectStub::create('s');
        $valueObject2 = ValueObjectStub::create('a');

        $this->assertFalse($valueObject2->equals($valueObject));
    }

    public function test_should_be_equal()
    {
        $valueObject = ValueObjectStub::create('s');
        $valueObject2 = ValueObjectStub::create('s');

        $this->assertTrue($valueObject2->equals($valueObject));
    }
}
