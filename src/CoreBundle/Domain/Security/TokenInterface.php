<?php

namespace CoreBundle\Domain\Security;

use CoreBundle\Domain\Security\Model\Entity\AuthUserInterface;

/**
 * Interface TokenInterface
 * @package CoreBundle\Domain\Security
 */
interface TokenInterface
{

    /**
     * @access public
     * @param AuthUserInterface $authUser
     * @return string
     */
    public function create(AuthUserInterface $authUser): string;
}
