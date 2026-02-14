<?php

/* ======================================
 * File for loading other project files &
 * Configuring the project
 * ====================================== */

declare(strict_types=1);

use Framework\App;
use App\Config\Routes;
use App\Config\Paths;

use function App\Config\registerMiddleware;

require __DIR__ . '/../../vendor/autoload.php';

$app = new App(Paths::SOURCE . 'App/container-definitions.php');

Routes::register($app);
registerMiddleware($app);

return $app;