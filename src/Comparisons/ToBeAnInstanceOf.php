<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToBeAnInstanceOf implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        return $subject instanceof $expectation;
    }
}
