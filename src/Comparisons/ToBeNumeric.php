<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToBeNumeric implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        return is_numeric($subject);
    }
}
