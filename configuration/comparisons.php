<?php

/**
 * This file contains the default comparisons that are shipped with the
 * framework.
 *
 * This file will be loaded when the framework boots.
 */

use Rawebone\Tapped\Comparisons;

return [
    new Comparisons\ToEqual,
    new Comparisons\NotToEqual,
    new Comparisons\ToBeAnInstanceOf,
    new Comparisons\ToBeTrue,
    new Comparisons\ToBeFalse,
    new Comparisons\ToBeNumeric,
    new Comparisons\ToBeBoolean,
    new Comparisons\ToBeString,
    new Comparisons\ToBeIntegral,
    new Comparisons\ToBeFloatingPoint,
    new Comparisons\ToContainKey,
    new Comparisons\ToContainValue,
];
