<?php

namespace CoreBundle\Domain\Security\Model\Entity;

/**
 * Interface AuthUserInterface
 * @package CoreBundle\Domain\Security\Model\Entity
 */
interface AuthUserInterface
{
    /**
     * @access public
     * @return string
     */
    public function id();

    /**
     * @access public
     * @return string
     */
    public function username();

    /**
     * @access public
     * @return string
     */
    public function email();

    /**
     * @access public
     * @return array
     */
    public function roles();
}
