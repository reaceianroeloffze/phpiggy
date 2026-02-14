<?php

declare(strict_types=1);

namespace Framework;

/**
 * Dynamically render HTML pages
 * */
class TemplateEngine
{
    public function __construct(
        private readonly string $basePath, // Absolute path to the views directory
        private ?array $globalTemplateData = []
    ) {
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
        // Extract global template data into the current scope
        extract($this->globalTemplateData, EXTR_SKIP);

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

    /**
     * Add global template data
     *
     * @param string $key <p>
     *     The key to store the data under
     * </p>
     * @param mixed $value <p>
     *     The value to store
     * </p>
     * */
    public function addGlobal(string $key, mixed $value): void
    {
        $this->globalTemplateData[$key] = $value;
    }
}