<?php

use function Rawebone\Tapped\{test, skip, todo};

test('Built-in comparisons', function ($expect) {
    $expect(1)->toEqual(1)->when('Equality test');
    $expect(1)->toNotEqual(2)->when('Non-equality test');

    // $expect(true)->toBeTrue()->when('Values can be compared as Truthy');
    // $expect(false)->toBeFalse()->when('Values can be compared as Falsey');
    // $expect(1)->toBeNumeric()->when('Integer values can be type checked as numeric');
    // $expect(1.0)->toBeNumeric()->when('Float values can be type checked as numeric');
    // $expect([])->toBeAnArray()->when('Array values can be type checked as an array');
    // $expect((object)[])->toBeAnObject()->when('Object values can be type checked as objects');
    // $expect('')->toBeStringable()->when('String values can be type checked as strings');
    // $expect(<to string object>)->toBeStringable()->when('');
});
