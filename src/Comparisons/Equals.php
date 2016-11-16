<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class Equals implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        return $subject === $expectation;
    }
}
