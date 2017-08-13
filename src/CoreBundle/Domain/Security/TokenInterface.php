<?php

namespace CoreBundle\Domain\Security;

/**
 * Interface TokenInterface
 * @package CoreBundle\Domain\Security
 */
interface TokenInterface
{

    /**
     * @access public
     * @param array $user
     * @return string
     */
    public function create(array $user): string;
}
