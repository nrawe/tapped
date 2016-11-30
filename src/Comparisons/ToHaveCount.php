<?php

namespace Rawebone\Tapped\Comparisons;

use Countable;
use Rawebone\Tapped\Comparison;

class ToHaveCount implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        if (is_array($subject) || $subject instanceof Countable) {
            return count($subject) === $expectation;
        }

        return false;
    }
}
