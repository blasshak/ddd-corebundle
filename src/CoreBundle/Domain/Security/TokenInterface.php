<?php

namespace CoreBundle\Domain\Security;

use CoreBundle\Domain\Model\Entity\AuthUser;

/**
 * Interface TokenInterface
 * @package CoreBundle\Domain\Security
 */
interface TokenInterface
{

    /**
     * @access public
     * @param AuthUser $authUser
     * @return string
     */
    public function create(AuthUser $authUser): string;
}
