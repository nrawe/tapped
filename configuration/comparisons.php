<?php

/**
 * This file contains the default comparisons that are shipped with the
 * framework.
 *
 * This file will be loaded when the framework boots.
 */

use Rawebone\Tapped\Comparisons;

return [
    new Comparisons\Equals,
    new Comparisons\DoesNotEqual,
    new Comparisons\ObjectTypeOf,
];
