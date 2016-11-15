<?php

namespace Rawebone\Tapped\Comparisons;

/**
 * This file contains the comparison system for the testing framework.
 *
 * Not everything needs to be an object, and most other assertion systems
 * are based on classes/objects. This is a very simple functional wrapper
 * to handle comparison.
 */

/**
 * Acts as the wrapper over our comparison mechanism.
 *
 * This should be the primary interface for making a comparison.
 */
function comparison($subject, $expectation, string $operator): bool
{
    switch ($operator) {
        case 'equals':
            return equals($subject, $expectation);

        case 'notEquals':
            return not_equals($subject, $expectation);
    }

    // By default, this assertion has not worked
    return false;
}

/**
 * Returns whether the subject and expectation are equal.
 */
function equals($subject, $expectation): bool
{
    return $subject === $expectation;
}

/**
 * Returns whether the subject and expectation are not equal.
 */
function not_equals($subject, $expectation): bool
{
    return ! equals($subject, $expectation);
}
