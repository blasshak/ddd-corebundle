<?php

namespace CoreBundle\Infrastructure\Bus\Command;

use CoreBundle\Domain\Bus\Command\CommandBusInterface;
use CoreBundle\Domain\Bus\Command\CommandInterface;
use CoreBundle\Infrastructure\Bus\Command\Exception\InvalidCommandException;
use CoreBundle\Infrastructure\Bus\Command\Exception\InvalidMiddlewareException;
use CoreBundle\Infrastructure\Bus\Command\Middleware\MiddlewareInterface;

class CommandBus implements CommandBusInterface
{
    /**
     * @access protected
     * @var array
     */
    protected $middlewares;

    /**
     * @var callable
     */
    private $middlewareChain;
    /**
     * @param MiddlewareInterface[] $middleware
     */

    /**
     * @access public
     * @param array $middlewares
     */
    public function __construct(array $middlewares)
    {
        $this->middlewares = $middlewares;
    }

    /**
     * @access public
     * @param array $middlewares
     * @return void
     */
    public function preHandle(array $middlewares)
    {
        $this->addMiddlewares($middlewares);
        $this->createExecutionChain();
    }

    /**
     * @access public
     * @param $middlewares
     * @return void
     */
    public function addMiddlewares($middlewares)
    {
        foreach ($middlewares as $k => $v) {
            array_splice($this->middlewares, $k, 0, array($middlewares[$k]));
        }
    }

    /**
     * @access private
     * @return void
     * @throws InvalidMiddlewareException
     */
    private function createExecutionChain()
    {
        $middlewares = $this->middlewares;

        $lastCallable = function () {
        };

        while ($middleware = array_pop($middlewares)) {
            if (! $middleware instanceof MiddlewareInterface) {
                throw InvalidMiddlewareException::forMiddleware($middleware);
            }

            $lastCallable = function ($command) use ($middleware, $lastCallable) {
                return $middleware->execute($command, $lastCallable);
            };
        }

        $this->middlewareChain = $lastCallable;
    }


    /**
     * Executes the given command and optionally returns a value
     * @access public
     * @param CommandInterface $command
     * @return mixed
     * @throws InvalidCommandException
     */
    public function handle(CommandInterface $command)
    {
        if (!$command instanceof CommandInterface) {
            throw InvalidCommandException::forUnknownValue($command);
        }

        $middlewareChain = $this->middlewareChain;

        return $middlewareChain($command);
    }
}
