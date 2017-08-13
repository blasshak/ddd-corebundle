<?php

namespace CoreBundle\Infrastructure\Symfony\Security;

use CoreBundle\Domain\Security\TokenInterface;
use CoreBundle\Infrastructure\Symfony\Security\Model\Entity\AuthUser;
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
     * @param array $user
     * @return string
     */
    public function create(array $user): string
    {
        $authUser = new AuthUser($user['id'], $user['username'], $user['email'], AuthUser::DEFAULT_ROLES);
        return $this->JWTManager->create($authUser);
    }
}
