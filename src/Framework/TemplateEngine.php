<?php

declare(strict_types=1);

namespace Framework;

/**
 * Dynamically render HTML pages
 * */
readonly class TemplateEngine
{
    public function __construct(
        private string $basePath, // Absolute path to the views directory
    )
    {
    }

    /**
     * Renders a template
     *
     * Uses output buffering to delay the rendering of the template
     * until PHP has finished generating the complete output.
     *
     * @param string $template <p>
     *     The name of the template file to render
     * </p>
     * @param array $data [Optional] <p>
     *     An associative array of data to pass to the template
     * </p>
     *
     * @return string|false <p>
     *     The completely rendered template, or false on failure
     * </p>
     * */
    public function render(
        string $template,
        array $data = []
    ): string|false {
        // Extract data into the current scope
        extract($data, EXTR_SKIP);

        // Start output buffering
        ob_start();

        // Include the template to be rendered.
        include $this->resolvePath($template);

        // Get the contents of the buffer and store it in memory
        $output = ob_get_contents();

        // Clean the buffer
        ob_end_clean();

        return $output;
    }

    /**
     * Use absolute paths for includes
     *
     * @param string $path <p>
     *     The path to the file to include
     * </p>
     *
     * @return string <p>
     *     The absolute path to the included file
     * </p>
     * */
    public function resolvePath(string $path): string
    {
        return "$this->basePath/$path";
    }
}