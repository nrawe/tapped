<?php

use Rawebone\Tapped\CallSite;
use function Rawebone\Tapped\test;

test(CallSite::class, function ($expect) {

    $call = (function () {
        return new CallSite(1);
    })();

    $expect($call->file())
        ->toEqual(__FILE__)
        ->when('The correct file is identified')
    ;

    $expect($call->line())
        ->toEqual(10) // This is the end of the method block calling the function
        ->when('The correct line is identified')
    ;
});
