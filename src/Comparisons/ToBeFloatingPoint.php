<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToBeFloatingPoint implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        return is_float($subject);
    }
}
