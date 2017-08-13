<?php

namespace CoreBundle\Tests\Infrastructure\Service\Container;

use CoreBundle\Domain\Security\TokenInterface;
use CoreBundle\Infrastructure\Symfony\Security\JWToken;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Mockery as m;

/**
 * Class JWTokenTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_symfony
 * @group core_bundle_infrastructure_symfony_security
 * @group unit_test
 * @package CoreBundle\Tests\Infrastructure\Service\Container
 */
class JWTokenTest extends KernelTestCase
{
    /**
     * @access private
     * @var TokenInterface
     */
    private $JWToken;

    /**
     * @access private
     * @var string
     */
    private $expected;

    public function setUp()
    {
        self::bootKernel();
        $this->expected = 'aaaa';
        $JWTManagerStub = m::mock(JWTManager::class);
        $JWTManagerStub->shouldReceive('create')->andReturn($this->expected);

        $this->JWToken = new JWToken($JWTManagerStub);
    }

    public function test_should_create_token()
    {
        $userAuth = array('id' => 'id', 'username' => 'id', 'email' => 'email');

        $token = $this->JWToken->create($userAuth);

        $this->assertEquals($this->expected, $token);
    }
}
