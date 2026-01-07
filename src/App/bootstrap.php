<?php

/* ======================================
 * File for loading other project files &
 * Configuring the project
 * ====================================== */

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use Framework\App;

$app = new App();

return $app;