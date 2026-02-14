<?php

declare(strict_types=1);

namespace Framework;

// Reflective Programming
use ReflectionClass, ReflectionNamedType;
use Framework\Exceptions\ContainerException;
use ReflectionException;

/**
 * Handles dependency injection
 * */
class Container
{
    private array $definitions = [];

    /**
     * Add new definitions to the container
     *
     * @param array $newDefinitions <p>
     *     An associative array of class names and their respective dependencies
     *
     * @throws ContainerException <p>
     *     If the class cannot be instantiated
     * </p>
     * */
    public function addDefinitions(array $newDefinitions): void
    {
        $this->definitions = [
            ...$this->definitions,
            ...$newDefinitions
        ];
    }

    /**
     * Inject dependencies into a class
     *
     * @param string $className <p>
     *     The name of the class to be instantiated
     * </p>
     *
     * @throws ContainerException <p>
     *     If the class cannot be instantiated
     * </p>
     *
     * */
    public function resolveDependencies(string $className): object
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("Class $className cannot be instantiated");
        }

        $constructor = $reflectionClass->getConstructor();

        $parameters = $constructor->getParameters();

        if (!$constructor || count($parameters) === 0) {
            return new $className;
        }

        // Store dependencies or class instances required by controllers
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            // Enforce parameter type hinting
            if (!$type) {
                throw new ContainerException(
                    <<<"ERROR_MSG"
                        Class $className
                        cannot be resolved
                        because parameter $name
                        is missing a type hint
                    ERROR_MSG
                );
            }

            if (
                !$type instanceof ReflectionNamedType ||
                $type->isBuiltin()) {
                throw new ContainerException(
                    <<<"ERROR_MSG"
                        Class $className
                        cannot be resolved
                        because parameter $name
                        is not a class
                    ERROR_MSG
                );
            }

            $dependencies[] = $this->getDependency($type->getName());
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    /**
     * Return an instance of a dependency
     *
     * @param string $id <p>
     *     The name of the class receiving the dependency
     * </p>
     *
     * @return object <p>
     *     An instance of the dependency
     * </p>
     * @throws ContainerException <p>
     *     If the class does not exist in the container
     * </p>
     * */
    public function getDependency(string $id): object
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException(
                "Class $id does not exist in the container"
            );
        }

        $factory = $this->definitions[$id];
        return $factory();
    }
}