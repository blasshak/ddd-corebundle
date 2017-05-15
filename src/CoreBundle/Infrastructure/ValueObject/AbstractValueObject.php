<?php

namespace CoreBundle\Infrastructure\ValueObject;

use CoreBundle\Domain\Model\ValueObject\ValueObjectInterface;

/**
 * Class AbstractValueObject
 * @package CoreBundle\Infrastructure\ValueObject
 */
abstract class AbstractValueObject implements ValueObjectInterface
{
    /**
     * @access protected
     * @var string
     */
    protected $value;

    /**
     * @access public
     * @param string $value
     * @return static
     */
    public static function create($value = '')
    {
        return new static($value);
    }

    /**
     * @access public
     * @param ValueObjectInterface $native
     * @return ValueObjectInterface
     */
    public static function fromNative(ValueObjectInterface $native)
    {
        return new static($native->value());
    }

    /**
     * @access public
     * @param ValueObjectInterface $object
     * @return bool
     */
    public function equals(ValueObjectInterface $object)
    {
        return $this->value() === $object->value();
    }

    /**
     * @access public
     * @return string
     */
    public function __toString()
    {
        return $this->value();
    }

    /**
     * @access public
     * @return string
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @access protected
     * @param string $value
     * @return void
     */
    protected function setValue($value)
    {
        $this->value = $value;
    }
}
