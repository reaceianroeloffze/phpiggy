<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Controller for the home page
 *
 * Handles the rendering of content on the home page
 * */
class HomeController
{
    /**
     * Displays the home page
     * */
    public function home(): void
    {
        echo 'This is the home page';
    }
}