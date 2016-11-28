<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToBeTrue implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        return $subject === true;
    }
}
