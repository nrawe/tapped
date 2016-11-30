<?php

use Rawebone\Tapped\Comparison;


class NamedComparison implements Comparison
{
    public function compare($a, $b): bool
    {
        return true;
    }

    public function name(): string
    {
        return 'Named';
    }
}


class UnnamedComparison implements Comparison
{
    public function compare($a, $b): bool
    {
        return true;
    }
}


class CountableObject implements Countable
{
    public function count()
    {
        return 1;
    }
}



