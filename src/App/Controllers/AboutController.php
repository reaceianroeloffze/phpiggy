<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

/**
 * Controller for the about page
 *
 * Handles the rendering of content on the about page
 * */
class AboutController
{
    public function __construct(
        private ?TemplateEngine $templateEngine = null
    ) {
        $this->templateEngine = $templateEngine ?? new TemplateEngine(Paths::VIEW);
    }

    /**
     * Renders the about page
     * */
    public function about(): void
    {
        echo $this->templateEngine->render(
            '/about.php',
            [
                'title' => 'About',
            ]
        );
    }
}