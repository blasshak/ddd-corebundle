<?php

namespace CoreBundle\Tests\Infrastructure\Service\Container;

use CoreBundle\Domain\Security\TokenInterface;
use CoreBundle\Infrastructure\Symfony\Security\Exception\InvalidAuthUserException;
use CoreBundle\Infrastructure\Symfony\Security\Model\Entity\AuthUser;
use CoreBundle\Infrastructure\Symfony\Security\UserStorage;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\InvalidTokenException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Mockery as m;

/**
 * Class UserStorageTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_symfony
 * @group core_bundle_infrastructure_symfony_security
 * @group unit_test
 * @package CoreBundle\Tests\Infrastructure\Service\Container
 */
class UserStorageTest extends KernelTestCase
{
    public function setUp()
    {
        self::bootKernel();
    }

    public function test_should_require_valid_token()
    {
        $token = array();
        $tokenStorage = $this->createTokenStorage($token);
        $userStorage = $this->createUserStorage($tokenStorage);

        $this->expectException(InvalidTokenException::class);
        $userStorage->get();
    }

    public function test_should_require_valid_user()
    {
        $user = array();
        $token = $this->createToken($user);
        $tokenStorage = $this->createTokenStorage($token);
        $userStorage = $this->createUserStorage($tokenStorage);

        $this->expectException(InvalidAuthUserException::class);
        $userStorage->get();
    }

    public function test_should_create_token()
    {
        $user = new AuthUser('', '', '', array());
        $token = $this->createToken($user);
        $tokenStorage = $this->createTokenStorage($token);
        $userStorage = $this->createUserStorage($tokenStorage);

        $result = $userStorage->get();

        $this->assertEquals($user, $result);
    }

    /**
     * @access private
     * @param TokenStorageInterface $tokenStorage
     * @return UserStorage
     */
    private function createUserStorage(TokenStorageInterface $tokenStorage)
    {
        return new UserStorage($tokenStorage);
    }

    /**
     * @access private
     * @param $token
     * @return m\MockInterface
     */
    private function createTokenStorage($token)
    {
        $tokenStorage = m::mock(TokenStorageInterface::class);
        $tokenStorage->shouldReceive('getToken')->andReturn($token);

        return $tokenStorage;
    }

    /**
     * @access private
     * @param $user
     * @return m\MockInterface
     */
    private function createToken($user)
    {
        $token = m::mock(TokenInterface::class);
        $token->shouldReceive('getUser')->andReturn($user);

        return $token;
    }
}
