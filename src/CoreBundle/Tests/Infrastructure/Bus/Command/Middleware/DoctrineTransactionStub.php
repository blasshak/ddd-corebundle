<?php

namespace CoreBundle\Tests\Infrastructure\Bus\Command\Middleware;

use CoreBundle\Domain\Bus\Command\CommandInterface;
use CoreBundle\Infrastructure\Bus\Command\Middleware\DoctrineTransaction;

/**
 * Class DoctrineTransactionStub
 * @package CoreBundle\Tests\Infrastructure\Bus\Command\Middleware
 */
class DoctrineTransactionStub extends DoctrineTransaction
{
    public function execute(CommandInterface $command, callable $next)
    {
        $this->rollbackTransaction();
    }
}
