<?php

namespace CoreBundle\Infrastructure\Bus\Command\Exception;

class InvalidCommandException extends \Exception
{
    /**
     * @var mixed
     */
    private $invalidCommand;
    /**
     * @param mixed $invalidCommand
     *
     * @return static
     */
    public static function forUnknownValue($invalidCommand) : InvalidCommandException
    {
        $exception = new static(
            'Commands must be an object but the value given was of type: ' . gettype($invalidCommand)
        );
        $exception->invalidCommand = $invalidCommand;
        return $exception;
    }
    /**
     * @return mixed
     */
    public function getInvalidCommand()
    {
        return $this->invalidCommand;
    }
}
