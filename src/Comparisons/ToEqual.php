<?php

namespace Rawebone\Tapped\Comparisons;

use Rawebone\Tapped\Comparison;

class ToEqual implements Comparison
{
    public function compare($subject, $expectation): bool
    {
        if (is_array($expectation)) {
            return $this->compareArray($subject, $expectation);
        }

        return $subject === $expectation;
    }

    public function compareArray($subject, $expectation): bool
    {
        if (!is_array($subject)) {
            return false;
        }

        foreach ($expectation as $key => $value) {
            if (!array_key_exists($key, $subject)) {
                return false;
            }

            if (!$this->compare($subject[$key], $value)) {
                return false;
            }
        }

        return true;
    }
}
