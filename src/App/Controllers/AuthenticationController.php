<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

/**
 * Controller for the register page
 * */
class AuthenticationController
{
    public function __construct(
        private ?TemplateEngine $templateEngine = null,

    ) {
        $this->templateEngine = $templateEngine ?? new TemplateEngine(Paths::VIEW);
    }

    /**
     * Renders the registration page
     * */
    public function registrationView(): void
    {
        echo $this->templateEngine->render(
            '/register.php',
        );
    }

    /**
     * Handle form submission
     * */
    public function registration(): void
    {
        dd($_POST);
    }
}