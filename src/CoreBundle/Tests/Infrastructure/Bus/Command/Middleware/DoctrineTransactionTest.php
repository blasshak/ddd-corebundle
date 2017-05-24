<?php

namespace CoreBundle\Tests\Infrastructure\Bus\Command\Middleware;

use CoreBundle\Domain\Bus\Command\CommandInterface;
use CoreBundle\Infrastructure\Bus\Command\Middleware\DoctrineTransaction;
use CoreBundle\Infrastructure\Bus\Command\Middleware\MiddlewareInterface;
use CoreBundle\Infrastructure\Service\Container\InvalidServiceException;
use CoreBundle\Tests\Infrastructure\Bus\Command\DummyCommand;
use Doctrine\ORM\EntityManagerInterface;
use \Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use \Mockery as m;

/**
 * Class CommandHandlerTest
 * @group core_bundle
 * @group core_bundle_infrastructure
 * @group core_bundle_infrastructure_bus_command_middleware
 * @group unit_test
 * @package CoreBundle\Tests\Infrastructure\Bus\Command\Middleware
 */
class DoctrineTransactionTest extends TestCase
{
    /**
     * @access private
     * @var CommandInterface
     */
    private $command;

    /**
     * @access private
     * @var callable
     */
    private $callable;

    public function setUp()
    {
        $this->command = new DummyCommand();
        $this->callable = function () {
        };
    }

    public function test_should_execute_invalid_service_exception()
    {
        $command = $this->command;
        $callable = $this->callable;
        $middleware = $this->createMiddleware(true);
        $isTransactionActive = true;
        $isRollbackOnly = false;
        $connectionMock = $this->createConnectionMock($isTransactionActive, $isRollbackOnly);
        $entityManagerMock = $this->createEntityManagerMock($connectionMock);
        $doctrineTransaction = $this->createDoctrineTransaction($entityManagerMock);
        $this->expectException(InvalidServiceException::class);

        $doctrineTransaction->execute($command, function () use ($middleware, $command, $callable) {
            $middleware->execute($command, $callable);
        });

        $entityManagerMock->mockery_verify();
    }

    public function test_should_close_connection_when_isRollbackOnly()
    {
        $command = $this->command;
        $callable = $this->callable;
        $isTransactionActive = true;
        $isRollbackOnly = true;
        $connectionMock = $this->createConnectionMock($isTransactionActive, $isRollbackOnly);
        $entityManagerMock = $this->createEntityManagerMock2($connectionMock);
        $doctrineTransactionStub = $this->createDoctrineTransactionStub($entityManagerMock);

        $doctrineTransactionStub->execute($command, $callable);

        $entityManagerMock->mockery_verify();
        $connectionMock->mockery_verify();
    }

    public function test_should_close_connection_when_isTransactionActive()
    {
        $command = $this->command;
        $callable = $this->callable;
        $isTransactionActive = false;
        $isRollbackOnly = false;
        $connectionMock = $this->createConnectionMock($isTransactionActive, $isRollbackOnly);
        $entityManagerMock = $this->createEntityManagerMock2($connectionMock);
        $doctrineTransactionStub = $this->createDoctrineTransactionStub($entityManagerMock);

        $doctrineTransactionStub->execute($command, $callable);

        $entityManagerMock->mockery_verify();
        $connectionMock->mockery_verify();
    }

    public function test_should_not_close_connection()
    {
        $command = $this->command;
        $callable = $this->callable;
        $isTransactionActive = true;
        $isRollbackOnly = false;
        $connectionMock = $this->createConnectionMock($isTransactionActive, $isRollbackOnly);
        $close = false;
        $entityManagerMock = $this->createEntityManagerMock2($connectionMock, $close);
        $doctrineTransactionStub = $this->createDoctrineTransactionStub($entityManagerMock);

        $doctrineTransactionStub->execute($command, $callable);

        $entityManagerMock->mockery_verify();
        $connectionMock->mockery_verify();
    }

    public function test_should_executed_successfully()
    {
        $command = $this->command;
        $callable = $this->callable;
        $expected = 111;
        $middleware = $this->createMiddleware(false);
        $entityManagerMock = $this->createEntityManagerMock3();
        $doctrineTransaction = $this->createDoctrineTransaction($entityManagerMock);

        $value = $doctrineTransaction->execute($command, function () use ($middleware, $command, $callable, $expected) {
            $middleware->execute($command, $callable);

            return $expected;
        });

        $entityManagerMock->mockery_verify();

        $this->assertEquals($expected, $value);
    }

    private function createMiddleware($exception)
    {
        $middlewareStub = m::mock(MiddlewareInterface::class);

        if ($exception) {
            $middlewareStub->shouldReceive('execute')->andThrowExceptions(array(new InvalidServiceException()));
        } else {
            $middlewareStub->shouldReceive('execute')->andReturnNull();
        }

        return $middlewareStub;
    }

    private function createEntityManagerMock(Connection $connection)
    {
        $entityManager = m::mock(EntityManagerInterface::class);

        $entityManager->shouldReceive('beginTransaction')->times(1)->andReturnNull();
        $entityManager->shouldReceive('rollback')->times(1)->andReturnNull();
        $entityManager->shouldReceive('getConnection')->times(1)->andReturn($connection);

        return $entityManager;
    }

    private function createEntityManagerMock2(Connection $connection, $close = true)
    {
        $entityManager = m::mock(EntityManagerInterface::class);

        $entityManager->shouldReceive('rollback')->times(1)->andReturnNull();
        $entityManager->shouldReceive('getConnection')->times(1)->andReturn($connection);

        if ($close) {
            $entityManager->shouldReceive('close')->times(1)->andReturnNull();
        }

        return $entityManager;
    }

    private function createEntityManagerMock3()
    {
        $entityManager = m::mock(EntityManagerInterface::class);

        $entityManager->shouldReceive('beginTransaction')->times(1)->andReturnNull();
        $entityManager->shouldReceive('flush')->times(1)->andReturnNull();
        $entityManager->shouldReceive('commit')->times(1)->andReturnNull();

        return $entityManager;
    }

    private function createConnectionMock($isTransactionActive, $isRollbackOnly)
    {
        $connection = m::mock(Connection::class);

        $isTransactionActiveTimes = 1;
        $isRollbackOnlyTimes = 1;

        if (!$isTransactionActive) {
            $isRollbackOnlyTimes = 0;
        }

        $connection->shouldReceive('isTransactionActive')->times($isTransactionActiveTimes)->andReturn($isTransactionActive);
        $connection->shouldReceive('isRollbackOnly')->times($isRollbackOnlyTimes)->andReturn($isRollbackOnly);

        return $connection;
    }

    /**
     * @access private
     * @param EntityManagerInterface $entityManager
     * @return MiddlewareInterface
     */
    private function createDoctrineTransaction(EntityManagerInterface $entityManager)
    {
        $doctrineTransaction = new DoctrineTransaction($entityManager);

        return $doctrineTransaction;
    }

    /**
     * @access private
     * @param EntityManagerInterface $entityManager
     * @return MiddlewareInterface
     */
    private function createDoctrineTransactionStub(EntityManagerInterface $entityManager)
    {
        $doctrineTransaction = new DoctrineTransactionStub($entityManager);

        return $doctrineTransaction;
    }
}
