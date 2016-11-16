<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Rawebone\Tapped\BailOutError;
use function Rawebone\Tapped\kernel;
use function Rawebone\Tapped\Protocol\bailOut;

try {
    kernel()->runTests();

} catch (BailOutError $bail) {
    // Handle framework startup issues
    bailOut($bail->getMessage());
}
