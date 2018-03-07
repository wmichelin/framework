<?php declare(strict_types=1);

namespace App\DependencyInjection;

use ReflectionClass;
use ReflectionMethod;

class IocContainer
{
    /**
     * @var array
     */
    private static $dependencyMap = [];

    /**
     * @param string $alias
     * @param string $instance
     */
    public function register(string $alias, string $instance)
    {
        self::$dependencyMap[$alias] = $instance;
    }

    /**
     * @return array
     */
    public function getBindings()
    {
        return self::$dependencyMap;
    }

    /**
     * @param string $className
     * @return mixed
     */
    public function resolve(string $className)
    {
        if (array_key_exists($className, self::$dependencyMap)) {
            return $this->resolve(self::$dependencyMap[$className]);
        }

        return new $className();
    }

    /**
     * @param callable $callable
     * @return mixed
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function invoke(callable $callable)
    {
        if (!is_array($callable) || sizeof($callable) !== 2 || !is_object($callable[0]) || !is_string($callable[1])) {
            throw new \Exception("don't know what to do with this yet");
        }

        [
            $obj,
            $methodName
        ] = $callable;

        return $this->invokeObjectMethodCall($obj, $methodName);
    }

    /**
     * @param $obj
     * @param string $methodName
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeObjectMethodCall($obj, string $methodName)
    {
        $reflection = new ReflectionClass($obj);
        $parameterBindings = $this->getParameterBindingsArray($reflection->getMethod($methodName));
        return call_user_func_array([$obj, $methodName], $parameterBindings);
    }

    /**
     * @param ReflectionMethod $reflectionMethod
     * @return array
     */
    private function getParameterBindingsArray(ReflectionMethod $reflectionMethod) : array
    {
        $parameterBindings = [];

        foreach ($reflectionMethod->getParameters() as $parameter) {
            array_push($parameterBindings, $this->resolve($parameter->getClass()->getName()));
        }

        return $parameterBindings;
    }
}
