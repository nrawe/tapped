<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToBeBoolean implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        return is_bool($subject);
    }
}
