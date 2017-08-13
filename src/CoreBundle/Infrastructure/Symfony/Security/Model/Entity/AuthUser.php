<?php

namespace CoreBundle\Infrastructure\Symfony\Security\Model\Entity;

use CoreBundle\Domain\Security\Model\Entity\AuthUserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Component\Security\Core\Encoder\EncoderAwareInterface;

/**
 * Class AuthUser
 * @package CoreBundle\Domain\Model\Entity
 */
final class AuthUser implements JWTUserInterface, AuthUserInterface, EncoderAwareInterface
{
    const DEFAULT_ROLES = [
        'ROLE_USER'
    ];

    /**
     * @access private
     * @var string
     */
    private $id;

    /**
     * @access private
     * @var string
     */
    private $username;

    /**
     * @access private
     * @var string
     */
    private $email;

    /**
     * @access private
     * @var array
     */
    private $roles = [];

    /**
     * AuthUser constructor.
     * @param string $id
     * @param string $username
     * @param string $email
     * @param array $roles
     */
    public function __construct(string $id, string $username, string $email, array $roles = [])
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = (string) $email;
        $this->roles = array_merge(self::DEFAULT_ROLES, $roles);
    }

    /**
     * @access public
     * @param string $username
     * @param array $payload
     * @return JWTUserInterface
     */
    public static function createFromPayload($username, array $payload)
    {
        return new self(
            $payload['uid'],
            $username,
            $payload['email'],
            $payload['roles']
        );
    }

    /**
     * @access public
     * @return string
     */
    public function id(): string
    {
        return $this->id;
    }

    /**
     * @access public
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @access public
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @access public
     * @return array
     */
    public function roles(): array
    {
        return $this->roles;
    }

    /**
     * @access public
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @access public
     * @return null
     */
    public function getPassword()
    {
        return null;
    }

    /**
     * @access public
     * @return null
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * @access public
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @access public
     * @return null
     */
    public function eraseCredentials()
    {
        return null;
    }

    /**
     * @access public
     * @return string
     */
    public function getEncoderName()
    {
        return 'harsh';
    }
}
