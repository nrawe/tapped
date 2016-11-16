<?php

use function Rawebone\Tapped\{test, skip, todo};

test('It performs basic equality tests', function ($expect) {
    $expect(1)->toEqual(1)->when('Equality test');
    $expect(1)->toNotEqual(2)->when('Non-equality test');
});
