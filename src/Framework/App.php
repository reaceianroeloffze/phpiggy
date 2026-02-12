<?php

declare(strict_types=1);

namespace Framework;

/**
 * Connect All necessary framework tools
 */
class App
{
    // Properties
    private Router $router;

    // Methods
    public function __construct()
    {
        $this->router = new Router();
    }

    /**
     * Run the application
     * */
    public function run(): void
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];
        $this->router->dispatch($path, $method);
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
}