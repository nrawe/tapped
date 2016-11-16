<?php

namespace Rawebone\Tapped;

use ReflectionClass;

/**
 * Comparator acts as the method by which we can make comparisons between values.
 *
 * To allow for flexible integration with third-party tooling which requires
 * bespoke comparisons, we define this as a dynamic handler.
 *
 * Third parties can then register their comparisons at framework startup for
 * use inside the users tests.
 */
class Comparator
{
    /**
     * The Comparisons that can be made.
     *
     * @var Comparison[]
     */
    protected $comparisons = [];

    /**
     * Finds the required handler and delegates to it to make the comparison.
     */
    public function compare(string $comparison, $subject, $expectation): bool
    {
        if (!$this->has($comparison)) {
            return false;
        }

        return $this->comparisons[$comparison]->compare($subject, $expectation);
    }

    /**
     * Returns whether the given comparison has been registered. 
     */
    public function has(string $comparison): bool
    {
        return array_key_exists($comparison, $this->comparisons);
    }

    /**
     * Registers a comparison for use.
     *
     * The key by which the Comparison can be accessed will be determined by
     * one of two methods--
     *
     * 1. If the comparison has a `name()` method, then that will be expected
     *    to return the name in string form.
     * 2. Otherwise the short class name will be used, with the first character
     *    lowercased.
     */
    public function register(Comparison $comparison)
    {
        $name = $this->getNameFor($comparison);

        $this->comparisons[$name] = $comparison;
    }

    /**
     * Registers many comparisons for use.
     */
    public function registerMany(array $comparisons)
    {
        foreach ($comparisons as $comparison) {
            if (!$comparison instanceof Comparison) {
                throw new BailOutError('Invalid comparison provided.');
            }

            $this->register($comparison);
        }
    }

    /**
     * Returns the real name of the comparison.
     */
    protected function getNameFor(Comparison $comparison): string
    {
        if (method_exists($comparison, 'name')) {
            return $comparison->name();
        }

        $reflection = new ReflectionClass($comparison);

        return lcfirst($reflection->getShortName());
    }
}
