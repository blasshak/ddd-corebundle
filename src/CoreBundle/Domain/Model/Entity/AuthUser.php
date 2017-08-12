<?php

namespace CoreBundle\Domain\Model\Entity;

/**
 * Class AuthUser
 * @package CoreBundle\Domain\Model\Entity
 */
final class AuthUser
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
    private $passwordHash;

    /**
     * @access private
     * @var array
     */
    private $roles = [];

    /**
     * AuthUser constructor.
     * @param string $id
     * @param string $username
     * @param string $encodedPassword
     * @param array $roles
     */
    public function __construct(string $id, string $username, string $encodedPassword, array $roles = [])
    {
        $this->id = $id;
        $this->username = $username;
        $this->passwordHash = (string) $encodedPassword;
        $this->roles = array_merge(self::DEFAULT_ROLES, $roles);
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
    public function password(): string
    {
        return $this->passwordHash;
    }

    /**
     * @access public
     * @return array
     */
    public function roles(): array
    {
        return $this->roles;
    }
}
