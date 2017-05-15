<?php

namespace CoreBundle\Tests\Infrastructure\ValueObject;

use CoreBundle\Infrastructure\ValueObject\AbstractValueObject;

/**
 * Class ValueObjectStub
 * @package CoreBundle\Tests\Infrastructure\ValueObject
 */
class ValueObjectStub extends AbstractValueObject
{
    /**
     * @access public
     * @param $value
     */
    protected function __construct($value)
    {
        $this->value = $value;
    }
}
