<?php

namespace CoreBundle\Infrastructure\Symfony\Security;

use CoreBundle\Domain\Security\Model\Entity\AuthUserInterface;
use CoreBundle\Domain\Security\TokenInterface;
use CoreBundle\Domain\Security\UserStorageInterface;
use CoreBundle\Infrastructure\Symfony\Security\Exception\InvalidAuthUserException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidTokenException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Guard\Token\GuardTokenInterface;

/**
 * Class UserStorage
 * @package CoreBundle\Infrastructure\Symfony\Security
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
     * @throws InvalidAuthUserException
     */
    public function get()
    {
        $token = $this->tokenStorage->getToken();

        if (!$token instanceof GuardTokenInterface) {
            throw new InvalidTokenException('Invalid token');
        }

        $user = $token->getUser();

        if (!$user instanceof AuthUserInterface) {
            throw new InvalidAuthUserException(InvalidAuthUserException::MESSAGE);
        }

        return $user;
    }
}
