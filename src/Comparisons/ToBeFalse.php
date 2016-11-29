<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToBeFalse extends ToBeTrue
{
    public function compare($subject, $expectation): bool
    {
        return ! parent::compare($subject, $expectation);
    }
}
