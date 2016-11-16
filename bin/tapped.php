<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Rawebone\Tapped\BailOutError;
use function Rawebone\Tapped\Protocol\bailOut;
use function Rawebone\Tapped\Harness\{kernel, comparisons, extensions, environment};

try {
    // Initialise the testing environment.
    environment(getcwd() . DIRECTORY_SEPARATOR . 'tests');

    // Load in the default comparisons which ship with the Framework.
    comparisons()->registerMany(
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
    
    // Boot all of the extensions.
    extensions()->boot();

    // Register the comparisons exposed by the extensions.
    extensions()->comparisons(comparisons());

    // Execute the tests.
    kernel()->run(
        environment()->testFiles()
    );

    // Shutdown all of the extensions.
    extensions()->shutdown();

} catch (BailOutError $bail) {
    // This is a specific error message, so the stack is irrelevant.
    bailOut($bail->getMessage());

} catch (Throwable $t) {
    // This is a general error, so the stack is important.
    bailOut((string)$t);
}
