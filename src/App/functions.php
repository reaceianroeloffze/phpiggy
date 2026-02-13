<?php

declare(strict_types=1);

/**
 * Dumps a scalar value or print reads an array/object
 *
 * @param mixed $value <p>
 *     The value to dump/print
 * </p>
 * */
function dd(mixed $value): void
{
    echo '<pre>';
    if (is_array($value) || is_object($value)) {
        print_r($value);
    } else {
        var_dump($value);
    }
    echo '</pre>';
    exit;
}

/**
 * appends the class constant to a controller class
 *
 * @param string $controller <p>
 *     The name of the controller class
 * </p>
 *
 * @return string <p>
 *     The full controller class name
 * </p>
 * */

/**
 * Escape HTML special characters with htmlspecialchars()
 *
 * @param mixed $value <p>
 *     The value to escape
 * </p>
 *
 * @return string <p>
 *     The escaped value
 * </p>
 * */
function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
