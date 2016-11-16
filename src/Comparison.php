<?php

namespace Rawebone\Tapped;

/**
 * A Comparison provides a simple interface for checking whether two values
 * are "equal". 
 */
interface Comparison
{
    public function compare($subject, $expectation): bool;
}
