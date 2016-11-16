<?php

namespace Rawebone\Tapped;

/**
 * This file contains the public interface of the testing framework.
 *
 * This allows us to use a more natural, clean flow for writing our tests.
 */

use Closure;
use function Rawebone\Tapped\Harness\kernel;

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
