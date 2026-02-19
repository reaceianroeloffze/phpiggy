<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{
    HomeController,
    AboutController,
    AuthenticationController
};

/**
 * Handle the registration of routes
 * */
class Routes
{
    /**
     * Register all routes for the application
     * */
    public static function register(App $app): void
    {
        // Homepage
        $app->getRoutePath(
            '/',
            [HomeController::class, 'home']
        );
        // About page
        $app->getRoutePath(
            '/about',
            [AboutController::class, 'about']
        );
        // Registration page
        $app->getRoutePath(
            '/register',
            [AuthenticationController::class, 'registrationView']
        );
        $app->postRoutePath(
            '/register',
            [AuthenticationController::class, 'registration']
        );
    }
}