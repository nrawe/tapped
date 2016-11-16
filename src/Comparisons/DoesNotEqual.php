<?php

namespace Rawebone\Tapped\Comparisons;

class DoesNotEqual extends Equals
{
    public function compare($subject, $expectation): bool
    {
        return ! parent::compare($subject, $expectation);
    }
    
    public function name()
    {
        return 'toNotEqual';
    }
}
