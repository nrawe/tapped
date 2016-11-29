<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToBeString implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        return is_string($subject);
    }
}
