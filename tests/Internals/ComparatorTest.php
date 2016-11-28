<?php

use Rawebone\Tapped\Comparator;
use Rawebone\Tapped\Comparison;
use function Rawebone\Tapped\test;

test(Comparator::class, function ($expect) {

    $comparator = new Comparator;
    $expect($comparator->has('named'))
        ->toEqual(false)
        ->when('No comparisons registered')
    ;

    $comparator->registerMany([
        new NamedComparison,
        new UnnamedComparison,
    ]);
    
    $expect($comparator->has('named'))
        ->toEqual(true)
        ->when('The named comparison has been registered')
    ;

    $expect($comparator->has('unnamedComparison'))
        ->toEqual(true)
        ->when('The unnamed comparison has been registered')
    ;

    $expect($comparator->compare('named', 1, 2))
        ->toEqual(true)
        ->when('The comparison can be made via the interface')
    ;
    
});
