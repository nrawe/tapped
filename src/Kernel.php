<?php

namespace Rawebone\Tapped;

use Closure;
use function Rawebone\Tapped\Protocol\{
    directive, version, ok, notOk, skip, todo, plan, blank, bailOut
};

/**
 * The Kernel acts as the centre of the testing framework.
 *
 * It is divided into sections for ease of understanding.
 */
class Kernel
{
    /**
     * The Comparisons which have been loaded for the framework.
     *
     * @var Comparator
     */
    protected $comparator;

    /**
     * The Extensions which have been loaded for the framework.
     *
     * @var Extensions
     */
    protected $extensions;

    /**
     * The counter for recording the amount of failures.
     *
     * @var int
     */
    protected $fails;

    /**
     * Records whether the TAP version line has been output.
     *
     * In the instance that there are no tests, we do not want to write
     * this out.
     *
     * @var bool
     */
    protected $hasProtocolBeenWritten;

    /**
     * The counter for recording the amount of passes.
     *
     * @var int
     */
    protected $passes;

    /**
     * The counter for recording the amount of tests in total.
     *
     * @var int
     */
    protected $tests;

    /**
     * Creates a new instance of the Kernel.
     */
    public function __construct(Comparator $comparator, Extensions $extensions)
    {
        $this->comparator = $comparator;
        $this->extensions = $extensions;
        $this->hasProtocolBeenWritten = false;
        $this->tests = 0;
        $this->passes = 0;
        $this->fails = 0;
    }

    //region Protocol Wrappers

    /**
     * Records the result of an assertion.
     */
    public function assertion(bool $result, string $description)
    {
        if (! $result) {
            $this->fail($description);
        } else {
            $this->pass($description);
        }
    }

    /**
     * Marks a failure.
     */
    public function fail(string $description)
    {
        $this->incrementFailCount();

        notOk($this->incrementTestCount(), $description);
    }

    /**
     * Marks a success.
     */
    public function pass(string $description)
    {
        $this->incrementPassCount();

        ok($this->incrementTestCount(), $description);
    }

    /**
     * Marks a skipped test.
     */
    public function skip(string $description)
    {
        $this->incrementFailCount();

        skip($this->incrementTestCount(), $description);
    }

    /**
     * Marks a test that is still todo.
     */
    public function todo(string $description)
    {
        $this->incrementFailCount();

        todo($this->incrementTestCount(), $description);
    }

    /**
     * Marks a critical situation and cancels testing.
     */
    public function bailOut(string $description)
    {
        throw new BailOutError($description);
    }

    //endregion


    //region Process Handlers

    /**
     * Runs all of the tests that can be found in the tests folder.
     */
    public function run(array $tests)
    {
        $runner = static function ($file) {
            require_once $file;
        };

        foreach ($tests as $test) {
            $runner($test);
        }

        $this->finishUp();
    }

    /**
     * Runs an individual test.
     */ 
    public function test(string $description, Closure $test)
    {
        $this->writeProtocolLine();

        $this->extensions->setup();

        directive($description);

        // Run the test. This is bound to the Kernel
        // so that users can wrap around the protocol
        // handling contained within it.
        $realTest = $test->bindTo($this);
        $realTest($this->makeAssertion());

        $this->extensions->tearDown();
    }

    //endregion


    //region Private Helpers

    protected function incrementTestCount(): int
    {
        return ++$this->tests;
    }

    protected function incrementPassCount(): int
    {
        return ++$this->passes;
    }

    protected function incrementFailCount(): int
    {
        return ++$this->fails;
    }

    protected function finishUp()
    {
        if ($this->hasProtocolBeenWritten) {
            // We only need to do this if there's something to write home about
            blank();
            plan($this->tests);
            
            directive('tests ' . $this->tests);
            directive('pass  ' . $this->passes);
            directive('fail  ' . $this->fails);
        }
    }

    protected function writeProtocolLine()
    {
        if (! $this->hasProtocolBeenWritten) {
            $this->hasProtocolBeenWritten = true;
            version(13);
        }
    }

    protected function makeAssertion(): Closure
    {
        return function ($subject) {
            return new Assertion($this, $this->comparator, $subject);
        };
    }

    //endregion
}
