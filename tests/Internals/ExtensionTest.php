<?php

use Rawebone\Tapped\Comparator;
use Rawebone\Tapped\Extension;
use Rawebone\Tapped\Extensions;
use function Rawebone\Tapped\test;


test('Extensions can be registered and executed', function ($expect) {

    $extension = new class extends Extension
    {
        function boot() { $this->boot = true; }
        function comparisons(Comparator $c) { $this->comparisons = true; }
        function setup() { $this->setup = true; }
        function tearDown() { $this->tearDown = true; }
        function shutdown() { $this->shutdown = true; }
    };


    $extensions = new Extensions;
    $extensions->registerMany([$extension]);
    $extensions->boot();
    $extensions->comparisons(new Comparator);
    $extensions->setup();
    $extensions->tearDown();
    $extensions->shutdown();


    $expect($extension->boot)->toEqual(true)->when('Extensions can be booted');
    $expect($extension->comparisons)->toEqual(true)->when('Extensions can register comparisons');
    $expect($extension->setup)->toEqual(true)->when('Extensions can be setup');
    $expect($extension->tearDown)->toEqual(true)->when('Extensions can be torn down');
    $expect($extension->shutdown)->toEqual(true)->when('Extensions can be shutdown');
});
