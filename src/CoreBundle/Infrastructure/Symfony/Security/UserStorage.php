<?php

namespace CoreBundle\Infrastructure\Symfony\Security;

use CoreBundle\Domain\Security\Model\Entity\AuthUserInterface;
use CoreBundle\Domain\Security\TokenInterface;
use CoreBundle\Domain\Security\UserStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class UserStorage
 * @package Leos\Infrastructure\SecurityBundle\Security
 */
class UserStorage implements UserStorageInterface
{
    /**
     * @access private
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @access public
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @access public
     * @return AuthUserInterface
     */
    public function get()
    {
        $token = $this->tokenStorage->getToken();

        if (!$token instanceof TokenInterface) {
            //sss
        }

        $user = $token->getUser();

        return $user;
    }
}
