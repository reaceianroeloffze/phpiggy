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
    private TemplateEngine $templateEngine;

    public function __construct()
    {
        $this->templateEngine = new TemplateEngine(Paths::VIEW);
    }

    /**
     * Displays the home page
     * */
    public function home(): void
    {
        echo $this->templateEngine->render(
            '/index.php',
            [
                'title' => 'Homepage',
            ]
        );
    }
}