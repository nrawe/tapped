<?php

namespace Rawebone\Tapped\Comparisons;

class NotToEqual extends ToEqual
{
    public function compare($subject, $expectation): bool
    {
        return ! parent::compare($subject, $expectation);
    }
}
