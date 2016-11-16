<?php

namespace Rawebone\Tapped\Harness;

/**
 * Initialises or returns the Kernel which actually runs the tests.
 */
function kernel(): Kernel
{
    static $instance;

    if (! $instance) {        
        $instance = new Kernel(
            comparisons(), extensions()
        );
    }

    return $instance;
}

/**
 * Initialises the testing environment instance.
 */
function environment($path = ''): Environment
{
    static $instance;

    if (! $instance) {
        $instance = new Environment($path);
    }

    return $instance;
}

/**
 * Initialises the extensions handling instance.
 */
function extensions(): Extensions
{
    static $instance;

    if (! $instance) {
        $instance = new Extensions();
    }

    return $instance;
}

/**
 * Initialises the comparison engine.
 */
function comparisons(): Comparator
{
    static $instance;

    if (! $instance) {
        $instance = new Comparator();
    }

    return $instance;
}
