<?php

namespace ZnCore\Instance\Libs\Resolvers;

use ZnCore\Container\Traits\ContainerAwareTrait;
use ZnCore\Contract\Common\Exceptions\InvalidConfigException;
use ZnCore\Instance\Exceptions\ClassNotFoundException;
use ZnCore\Instance\Helpers\ClassHelper;

class InstanceResolver
{

    use ContainerAwareTrait;

    public function callMethod(object $instance, string $methodName, array $parameters = [])
    {
//        return $this->callMethod2($instance, $methodName, $parameters);
        $parameters = $this->prepareParameters(get_class($instance), $methodName, $parameters);
        return call_user_func_array([$instance, $methodName], $parameters);
    }

    public function callMethod2(object $instance, string $methodName, array $parameters = [])
    {
        $callable = [$instance, $methodName];
        $argumentResolver = new ArgumentMetadataResolver($this->container);
//        $argumentResolver = $this->container->get(ArgumentMetadataResolver::class);
        $parameters = $argumentResolver->resolve($callable, $parameters);
//        $parameters = $this->prepareParameters(get_class($instance), $methodName, $parameters);
        return call_user_func_array($callable, $parameters);
    }

    public function make(string $definition, array $constructParams = []): object
    {
        $callable = [$definition, '__construct'];
        /** @var ArgumentMetadataResolver $argumentResolver */
        $argumentResolver = $this->container->get(ArgumentMetadataResolver::class);
        $resolvedArguments = $argumentResolver->resolve($callable, $constructParams);
        return $this->create($definition, $resolvedArguments);
    }

    /**
     * Создать класс
     * @param $definition
     * @param array $constructParams
     * @return object
     * @throws \ZnCore\Contract\Common\Exceptions\InvalidConfigException
     */
    public function create($definition, array $constructParams = []): object
    {
        if (empty($definition)) {
            throw new InvalidConfigException('Empty class config');
        }
        $definition = ClassHelper::normalizeComponentConfig($definition);

        if (empty($constructParams) && array_key_exists('__construct', $definition)) {
            $constructParams = $definition['__construct'];
            unset($definition['__construct']);
        }
        $handlerInstance = $this->createObject($definition['class'], $constructParams);

        ClassHelper::configure($handlerInstance, $definition);
        return $handlerInstance;
    }

    /**
     * Обеспечить инстанс класса
     * Если придет объект в определении класса, то он его вернет, иначе создаст новый класс.
     * @param $definition
     * @param array $constructParams
     * @return object
     */
    public function ensure($definition, $constructParams = []): object
    {
        if (is_object($definition)) {
            return $definition;
        }
        return $this->create($definition, $constructParams);
    }

    private function prepareParameters(string $className, string $methodName, array $constructionArgs): array
    {
        $container = $this->ensureContainer();
        $methodParametersResolver = new MethodParametersResolver($container, $this);
        return $methodParametersResolver->resolve($className, $methodName, $constructionArgs);
    }

    /**
     * @param string $className
     * @param array $constructionArgs
     * @return object
     * @throws ClassNotFoundException
     */
    private function createObject(string $className, array $constructionArgs = []): object
    {
        if (!class_exists($className)) {
//            dd($className);
            throw new ClassNotFoundException($className);
        }
        $constructionArgs = $this->prepareParameters($className, '__construct', $constructionArgs);
        return $this->createObjectInstance($className, $constructionArgs);
    }

    private function createObjectInstance(string $className, array $constructionArgs): object
    {
        if (count($constructionArgs) && method_exists($className, '__construct')) {
//            $instance = new $className(...$constructionArgs);
            $reflectionClass = new \ReflectionClass($className);
            $instance = $reflectionClass->newInstanceArgs($constructionArgs);
        } else {
            $instance = new $className();
        }
        return $instance;
    }
}
