<?php

namespace Rawebone\Tapped;

use function Rawebone\Tapped\Comparisons\comparison;

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
    public function __construct(Kernel $kernel, $subject)
    {
        $this->kernel = $kernel;
        $this->subject = $subject;
    }

    /**
     * Registers that the value should be compared for equality.
     */
    public function toEqual($expectation): Assertion
    {
        return $this->comparison('equals', $expectation);
    }


    /**
     * Registers that the value should be compared for non-equality.
     */
    public function toNotEqual($expectation): Assertion
    {
        return $this->comparison('notEquals', $expectation);
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
        $this->kernel->assertion(
            comparison($this->subject, $this->expectation, $this->comparison),
            $this->description
        );
    }

    /**
     * Registers the comparison which should be made.
     */
    protected function comparison(string $comparison, $expectation): Assertion
    {
        $this->comparison = $comparison;
        $this->expectation = $expectation;

        return $this;
    }
}
