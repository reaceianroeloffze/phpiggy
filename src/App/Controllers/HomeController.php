<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

/**
 * Controller for the home page
 *
 * Handles the rendering of content on the home page
 * */
class HomeController
{

    public function __construct(
        private ?TemplateEngine $templateEngine = null
    )
    {
        $this->templateEngine = $templateEngine ?? new TemplateEngine(Paths::VIEW);
    }

    /**
     * Displays the home page
     * */
    public function home(): void
    {
        echo $this->templateEngine->render(
            '/index.php',
        );
    }
}