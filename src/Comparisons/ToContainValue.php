<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToContainValue implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        if (! is_array($subject)) {
            return false;
        }

        return in_array($expectation, $subject, true);
    }
}
