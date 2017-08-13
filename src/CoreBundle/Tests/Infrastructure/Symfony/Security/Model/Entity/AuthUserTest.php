<?php

namespace CoreBundle\Tests\Infrastructure\Service\Container;

use CoreBundle\Infrastructure\Symfony\Security\Model\Entity\AuthUser;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Mockery as m;

/**
 * Class AuthUserTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_symfony
 * @group core_bundle_infrastructure_symfony_security
 * @group core_bundle_infrastructure_symfony_security_model
 * @group core_bundle_infrastructure_symfony_security_model_entity
 * @group unit_test
 * @package CoreBundle\Tests\Infrastructure\Service\Container
 */
class AuthUserTest extends KernelTestCase
{
    public function setUp()
    {
        self::bootKernel();
    }

    public function test_should_create_auth_user_from_payload()
    {
        $username = 'username';
        $payload = array('uid' => 'id', 'email' => 'email', 'roles' => AuthUser::DEFAULT_ROLES);

        $authUser = AuthUser::createFromPayload($username, $payload);

        $this->assertInstanceOf(AuthUser::class, $authUser);
    }
}
