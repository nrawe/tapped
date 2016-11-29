<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToBeIntegral implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        return is_int($subject);
    }
}
