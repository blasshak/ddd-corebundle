<?php

namespace CoreBundle\Infrastructure\Bus\Command\Middleware;

use CoreBundle\Domain\Bus\Command\CommandInterface;
use CoreBundle\Infrastructure\Service\Container\InvalidServiceException;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DoctrineTransaction
 * @package CoreBundle\Infrastructure\Bus\Command\Middleware
 */
class DoctrineTransaction implements MiddlewareInterface
{
    /**
     * @access private
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @access public
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @access public
     * @param CommandInterface $command
     * @param callable $next
     * @return mixed
     * @throws \Exception
     */
    public function execute(CommandInterface $command, callable $next)
    {
        $this->entityManager->beginTransaction();

        try {
            $returnValue = $next($command);
            $this->entityManager->flush();
            $this->entityManager->commit();
        } catch (\Exception $e) {
            $this->rollbackTransaction();
            throw $e;
        }

        return $returnValue;
    }

    /**
     * @access protected
     * @return void
     */
    protected function rollbackTransaction()
    {
        $this->entityManager->rollback();
        $connection = $this->entityManager->getConnection();

        if (!$connection->isTransactionActive() || $connection->isRollbackOnly()) {
            $this->entityManager->close();
        }
    }
}
