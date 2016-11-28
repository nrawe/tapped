<?php

namespace Rawebone\Tapped;

/**
 * Assertion provides a mechanism for fluently testing a value against
 * another value.
 *
 * This gives very clean code compared to some of the other expectation
 * libraries out there. 
 */
class Assertion
{
    /**
     * The actual comparison that should be made.
     *
     * @var string
     */
    protected $comparison;

    /**
     * The Comparisons that are available.
     *
     * @var Comparator
     */
    protected $comparator;

    /**
     * The description of what the assertion is for.
     *
     * @var string
     */
    protected $description;
    
    /**
     * What the value is expected to be.
     *
     * @var mixed
     */
    protected $expectation;

    /**
     * The Kernel instance for recording the assertion against.
     *
     * @var Kernel
     */
    protected $kernel;

    /**
     * The value that should be tested.
     *
     * @var mixed
     */
    protected $subject;

    /**
     * Creates a new instance of the Assertion.
     */
    public function __construct(Kernel $kernel, Comparator $comparator, $subject)
    {
        $this->kernel = $kernel;
        $this->comparator = $comparator;
        $this->subject = $subject;
    }

    /**
     * Dynamically call for the comparison.
     */
    public function __call($name, $args): Assertion
    {
        // The argument here is not forced - this allows us to call methods
        // such as `toBeTrue()` for better semantics.
        return $this->comparison($name, $args[0] ?? null);
    }

    /**
     * The message which describes what the assertion is testing.
     */
    public function when(string $description): Assertion
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Performs the actual comparison and records this against the Kernel.
     *
     * This is handled in the destructor so that we can more naturally write
     * our assertions. 
     */
    public function __destruct()
    {
        $result = $this->comparator->compare(
            $this->comparison, $this->subject, $this->expectation
        );

        $this->kernel->assertion($result, $this->description ?? '');
    }

    /**
     * Registers the comparison which should be made.
     */
    protected function comparison(string $comparison, $expectation): Assertion
    {
        if (! $this->comparator->has($comparison)) {
            throw new BailOutError('Unknown comparison ' . $comparison);
        }

        $this->comparison = $comparison;
        $this->expectation = $expectation;

        return $this;
    }
}
