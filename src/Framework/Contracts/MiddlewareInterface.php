<?php

declare(strict_types=1);

namespace Framework\Contracts;

/**
 * Contract for running Middleware
 * */
interface MiddlewareInterface
{
    /**
     * Process next middleware in the queue
     *
     * @param callable $next <p>
     *     The next middleware to be called
     * </p>
     * */
    public function process(callable $next);
}