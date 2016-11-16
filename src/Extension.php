<?php

namespace Rawebone\Tapped;

/**
 * Extensions provide a way to thread into the handling of the framework
 * without major pains.
 * 
 * For example, Code Coverage can be implemented as an extension instead
 * of requiring first class support inside of the framework.
 *
 * These lifecycle hooks can even be used to handle things like setting
 * up dependency containers for use in Web Frameworks.
 */
abstract class Extension
{
    /**
     * This method will be called when the framework is first loading.
     */
    public function boot()
    {
        // noop
    }

    /**
     * This method will be called to register the extension specific
     * comparisons.  
     */
    public function comparisons(Comparator $comparator)
    {
        // noop
    }

    /**
     * This method will be called just before a test is executed.
     */
    public function setup()
    {
        // noop
    }

    /**
     * This method will be called just after a test is executed.
     */
    public function tearDown()
    {
        // noop
    }

    /**
     * This method will be called when the framework is shutting down.
     */
    public function shutdown()
    {
        // noop
    }
}
