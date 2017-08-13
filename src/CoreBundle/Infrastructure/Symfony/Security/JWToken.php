<?php

namespace CoreBundle\Infrastructure\Symfony\Security;

use CoreBundle\Domain\Security\Model\Entity\AuthUserInterface;
use CoreBundle\Domain\Security\TokenInterface;
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
     * @param AuthUserInterface $authUser
     * @return string
     */
    public function create(AuthUserInterface $authUser): string
    {
        return $this->JWTManager->create($authUser);
    }
}
