<?php

use Rawebone\Tapped\Comparison;
use function Rawebone\Tapped\{test, skip, todo};

test('Built-in comparisons', function ($expect) {
    
    $expect(1)
        ->toEqual(1)
        ->when('Values can be compared for equality')
    ;
    
    $expect(1)
        ->notToEqual(2)
        ->when('Values can be compared for non-equality')
    ;

    $expect(true)
        ->toBeTrue()
        ->when('Values can be validated as boolean true')
    ;

    $expect(false)
        ->toBeFalse()
        ->when('Values can be validated as boolean true')
    ;

    $expect(new NamedComparison)
        ->toBeAnInstanceOf(Comparison::class)
        ->when('Object contracts can be compared')
    ;

    $expect(1)
        ->toBeNumeric()
        ->when('Integer values can be type checked as numeric')
    ;

    $expect(1)
        ->toBeIntegral()
        ->when('Integer values can be type checked as integers')
    ;

    $expect(1.0)
        ->toBeNumeric()
        ->when('Float values can be type checked as numeric')
    ;

    $expect(1.0)
        ->toBeFloatingPoint()
        ->when('Float values can be type checked as floats')
    ;

    $expect('')
        ->toBeString()
        ->when('String values can be type checked as strings')
    ;

    $expect(['key' => 'value'])
        ->toContainKey('key')
        ->when('Array values can be checked for key names')
    ;

    $expect([1, 2, 3, 4, 5])
        ->toContainValue(4)
        ->when('Array values can be checked for having a value')
    ;

    $expect([1, 2, 3, 4, 5])
        ->toHaveCount(5)
        ->when('Arrays can be counted')
    ;

    $expect(new CountableObject)
        ->toHaveCount(1)
        ->when('Objects implementing Countable can be counted')
    ;
});
