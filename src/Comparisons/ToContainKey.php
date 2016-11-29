<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToContainKey implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        if (! is_array($subject)) {
            return false;
        }

        return array_key_exists($expectation, $subject);
    }
}
