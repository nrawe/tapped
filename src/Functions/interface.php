<?php

namespace Rawebone\Tapped;

/**
 * This file contains the public interface of the testing framework.
 *
 * This allows us to use a more natural, clean flow for writing our tests.
 */

use Closure;

/**
 * Performs a test.
 */
function test(string $description, Closure $test)
{
    kernel()->test($description, $test);
}

/**
 * Records that the given test has been disabled.
 */
function skip(string $description, Closure $test)
{
    kernel()->skip($description);
}

/**
 * Records that the given test is not ready for use.
 */
function todo(string $description, Closure $test)
{
    kernel()->todo($description);
}

/**
 * Initialises or returns the Kernel which actually runs the tests.
 */
function kernel(): Kernel
{
    static $instance;

    if (! $instance) {
        $environment = new Environment(getcwd().DIRECTORY_SEPARATOR.'tests');
        $extensions = new Extensions($environment->extensions());
        
        $instance = new Kernel($environment, $extensions);
    }

    return $instance;
}
