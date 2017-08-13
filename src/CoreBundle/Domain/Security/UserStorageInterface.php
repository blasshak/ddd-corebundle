<?php

namespace CoreBundle\Domain\Security;

use CoreBundle\Domain\Security\Model\Entity\AuthUserInterface;

/**
 * Interface TokenInterface
 * @package CoreBundle\Domain\Security
 */
interface UserStorageInterface
{

    /**
     * @access public
     * @return AuthUserInterface
     */
    public function get();
}
