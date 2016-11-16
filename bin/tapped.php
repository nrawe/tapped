<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Rawebone\Tapped\BailOutError;
use function Rawebone\Tapped\Protocol\bailOut;
use function Rawebone\Tapped\Harness\{kernel, comparator, extensions, environment};

try {
    // Initialise the testing environment.
    environment(getcwd() . DIRECTORY_SEPARATOR . 'tests');

    // Load in the default comparisons which ship with the Framework.
    comparator()->registerMany(
        require_once __DIR__ . '/../configuration/comparisons.php'
    );

    // Load in the default extensions which ship with the Framework.
    extensions()->registerMany(
        require_once __DIR__ . '/../configuration/extensions.php'
    );

    // Load in the user requested extensions.
    extensions()->registerMany(
        environment()->extensions()
    );
    
    // Execute the tests.
    kernel()->runTests(
        environment()->testFiles()
    );

} catch (BailOutError $bail) {
    // Handle framework startup issues
    bailOut($bail->getMessage());
}
