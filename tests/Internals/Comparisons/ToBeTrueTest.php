<?php

use function Rawebone\Tapped\test;
use Rawebone\Tapped\Comparisons\ToBeTrue;

test(ToBeTrue::class, function ($expect) {

    $result = (new ToBeTrue)->compare(true, null); 

    $expect($result)
        ->toBeTrue()
        ->when('Comparison for truthiness can be made')
    ;
});
