<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ObjectTypeOf implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        return $subject instanceof $expectation;
    }

    public function name()
    {
        return 'toBeAnInstanceOf';
    }
}
