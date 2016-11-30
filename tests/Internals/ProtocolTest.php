<?php

use function Rawebone\Tapped\test;
use function Rawebone\Tapped\Protocol\{
    ok, notOk, bailOut, skip, todo, plan, version, directive, yaml
};

$normaliseLineEndings = function ($text) {
    return preg_replace('/(\n\r|\n|\r)/', PHP_EOL, $text);
};

test('Protocol Usage', function ($expect) use ($normaliseLineEndings) {

    $tap = <<<TAP
TAP version 13
1..4
# My test
ok 1 My test was complete
not ok 2 My test was not complete
    ---
    key: 1
    ...
not ok 3 # SKIP Meh
not ok 4 # TODO Will come to that later
bail out! Oh no!

TAP;

    ob_start();
    
    version(13);
    plan(4);
    directive('My test');
    ok(1, 'My test was complete');
    notOk(2, 'My test was not complete');
    yaml(['key' => 1]);
    skip(3, 'Meh');
    todo(4, 'Will come to that later');
    bailOut('Oh no!');

    $expect($normaliseLineEndings(ob_get_clean()))
        ->toEqual($normaliseLineEndings($tap))
    ;
});
