<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Middleware\TemplateDataMiddleware;


/**
 * Register Middleware to the application
 *
 * @param App $app <p>
 *     An instance of the application
 * </p>
 */
function registerMiddleware(App $app): void
{
    $app->addMiddleware(TemplateDataMiddleware::class);
}
