<?php

declare(strict_types=1);

namespace Framework;

/**
 * Control the rendering of content on a webpage
 * */
class Router
{
    // Properties
    private array $routes = [];


    /**
     * Add paths to the routes array
     *
     * @param string $path <p>
     *     The path to the file with the required contents
     * </p>
     * @param array $controller <p>
     *     The controller to be called when the route is hit along with its method
     * </p>
     * */
    public function addRoutePath(string $method, string $path, array $controller): void
    {
        $path = $this->normalisePath($path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller,
        ];
    }


    /**
     * Normalises a URL path
     *
     * Adds a '/' to the beginning and end of a path
     *
     * @param string $path <p>
     *     The URL path to normalise
     * </p>
     *
     * @return string The normalised URL path
     */
    private function normalisePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/$path/";
        $path = preg_replace('#/{2,}+#', '/', $path);
        return $path;
    }

    /**
     * Dispatch (send) controller content to the browser
     *
     * @param string $path <p>
     *     The URL path to dispatch to
     * </p>
     * @param string $method <p>
     *    The HTTP method to use
     * </p>
     * @param Container|null $container [Optional] <p>
     *    The container to use for dependency injection
     * */
    public function dispatch(
        string $path,
        string $method,
        ?Container $container = null
    ): void {
        $path = $this->normalisePath($path);
        $method = strtoupper($method);

        // Loop through routes and dispatch to the correct controller
        foreach ($this->routes as $route) {
            if (
                !preg_match("#^{$route['path']}$#", $path) ||
                $route['method'] !== $method
            ) {
                continue;
            }

            [$class, $function] = $route['controller'];

            // Create an instance of the controller through dependency injection
            $controllerInstance = $container ?
                $container->resolveDependencies($class) :
                new $class();

            $controllerInstance->$function();
        }
    }
}