<?php

declare(strict_types=1);

namespace Framework;

/**
 * Connect All necessary framework tools
 */
readonly class App
{

    public function __construct(
        ?string $containerDefinitionsPath = null,
        private Router $router = new Router(),
        private Container $container = new Container(),
    ) {
        // Add container definitions if any
        if ($containerDefinitionsPath) {
            $containerDefinitions = require $containerDefinitionsPath;
            $this->container->addDefinitions($containerDefinitions);
        }
    }

    /**
     * Run the application
     * */
    public function run(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        $this->router->dispatch(
            $path,
            $method,
            $this->container
        );
    }

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
    public function getRoutePath(string $path, array $controller): void
    {
        $this->router->addRoutePath('GET', $path, $controller);
    }

    /**
     * Add middleware to the router from the application instance
     *
     * @param string $middleware <p>
     *     The middleware class to add
     * </p>
     */
    public function addMiddleware(string $middleware): void
    {
        $this->router->addMiddleware($middleware);
    }
}