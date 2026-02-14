<?php

/**
 * Create dependency injection definitions for the container
 * */

declare(strict_types=1);

use Framework\Container;
use App\Config\Paths;
use Framework\TemplateEngine;

return [
    TemplateEngine::class => fn() => new TemplateEngine(Paths::VIEW), // Factory function
];