<?php

namespace CoreBundle\Domain\Model\ValueObject;

/**
 * Class ValueObjectInterface
 * @package CoreBundle\Domain\Model\ValueObject
 */
interface ValueObjectInterface
{
    /**
     * @access public
     * @param string $value
     * @return static
     */
    public static function create($value = '');

    /**
     * @access public
     * @param self $native
     * @return ValueObjectInterface
     */
    public static function fromNative(ValueObjectInterface $native);

    /**
     * @access public
     * @param self $object
     * @return bool
     */
    public function equals(ValueObjectInterface $object);

    /**
     * @access public
     * @return string
     */
    public function __toString();

    /**
     * @access public
     * @return string
     */
    public function value();
}
