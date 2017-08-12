<?php

namespace CoreBundle\Infrastructure\Symfony\Security;

use CoreBundle\Domain\Model\Entity\AuthUser;
use CoreBundle\Domain\Security\TokenInterface;
use CoreBundle\Infrastructure\Symfony\Security\Model\Auth;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;

/**
 * Class JWToken
 * @package Leos\Infrastructure\SecurityBundle\Security
 */
class JWToken implements TokenInterface
{
    /**
     * @access private
     * @var JWTManager
     */
    private $JWTManager;

    /**
     * @access public
     * @param JWTManager $JWTManager
     */
    public function __construct(JWTManager $JWTManager)
    {
        $this->JWTManager = $JWTManager;
    }

    /**
     * @access public
     * @param AuthUser $authUser
     * @return string
     */
    public function create(AuthUser $authUser): string
    {
        $auth = new Auth($authUser);

        return $this->JWTManager->create($auth);
    }
}
