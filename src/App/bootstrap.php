<?php

/* ======================================
 * File for loading other project files &
 * Configuring the project
 * ====================================== */

declare(strict_types=1);

use Framework\App;

use App\Config\Routes;

require __DIR__ . '/../../vendor/autoload.php';

$app = new App();

Routes::register($app);

return $app;