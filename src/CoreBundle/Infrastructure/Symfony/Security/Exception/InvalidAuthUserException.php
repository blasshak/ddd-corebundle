<?php

namespace CoreBundle\Infrastructure\Symfony\Security\Exception;

/**
 * Class InvalidAuthUserException
 * @package CoreBundle\Infrastructure\Symfony\Security\Exception
 */
class InvalidAuthUserException extends \Exception
{
    const MESSAGE = 'Invalid auth user';
}
