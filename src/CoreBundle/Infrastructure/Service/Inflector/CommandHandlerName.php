<?php

namespace CoreBundle\Infrastructure\Service\Inflector;

use CoreBundle\Domain\Bus\Command\CommandInterface;

/**
 * Class CommandHandlerName
 * @package CoreBundle\Infrastructure\Service\Inflector
 */
class CommandHandlerName implements InflectorInterface
{
    /**
     * @access public
     * @param CommandInterface $command
     * @return string
     */
    public function inflect(CommandInterface $command) : string
    {
        $reflectionClass = (new \ReflectionClass($command));

        $firstLevel = $this->getFirstLevel($reflectionClass);
        $secondLevel = $this->getSecondLevel($reflectionClass);
        $name = $this->getServiceName($reflectionClass);

        return $firstLevel.'.'.$secondLevel.'.'.$name;
    }

    /**
     * @access private
     * @param \Reflector $reflector
     * @return string
     */
    private function getFirstLevel(\Reflector $reflector)
    {
        $namespaceName = explode('\\', $reflector->getNamespaceName());
        $split = preg_split('/(?<=\\w)(?=[A-Z])/', $namespaceName[0]);
        $firstLevel = '';

        if (count($split) === 2) {
            $firstLevel = strtolower(substr($split[0], 0, 1).substr($split[1], 0, 1));
        }

        return $firstLevel;
    }

    /**
     * @access private
     * @param \Reflector $reflector
     * @return string
     */
    private function getSecondLevel(\Reflector $reflector)
    {
        $namespaceName =  explode('\\', strtolower($reflector->getNamespaceName()));
        $levelNames = array('application', 'domain', 'infrastructure');
        $secondLevel = '';

        foreach ($levelNames as $levelName) {
            if (in_array($levelName, $namespaceName)) {
                $secondLevel = $levelName;
                break;
            }
        }

        return $secondLevel;
    }

    /**
     * @access private
     * @param \Reflector $reflector
     * @return string
     */
    private function getServiceName(\Reflector $reflector)
    {
        $str = $reflector->getShortName();
        $split = preg_split('/(?<=\\w)(?=[A-Z])/', $str);
        array_push($split, 'handler');
        $name = strtolower(implode('_', $split));

        return $name;
    }
}
