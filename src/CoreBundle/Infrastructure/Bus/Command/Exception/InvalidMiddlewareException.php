<?php

namespace CoreBundle\Infrastructure\Bus\Command\Exception;

class InvalidMiddlewareException extends \Exception
{
    /**
     * @var mixed
     */
    private $invalidCommand;
    /**
     * @param mixed $middleware
     *
     * @return static
     */
    public static function forMiddleware($middleware) : InvalidMiddlewareException
    {
        $name = is_object($middleware) ? get_class($middleware) : gettype($middleware);
        $message = sprintf(
            'Cannot add "%s" to middleware chain as it does not implement the Middleware interface.',
            $name
        );
        return new static($message);
    }

    /**
     * @return mixed
     */
    public function getInvalidCommand()
    {
        return $this->invalidCommand;
    }
}
