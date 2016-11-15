<?php

namespace Rawebone\Tapped;

/**
 * Extensions provides a simple way to call the lifecycle hooks
 * on all of the extensions that are needed for testing.
 */
class Extensions extends Extension
{
    /**
     * An array of the loaded extensions to be operated upon.
     *
     * @var Extension[]
     */ 
    protected $loaded;

    /**
     * Creates a new instance of the Extensions object.
     */
    public function __construct(array $extensions)
    {
        $this->loaded = $extensions;

        $this->validate();
    }


    //region Extension Methods

    /**
     * {@inheritDoc}
     */
    public function boot()
    {
        $this->each(__FUNCTION__);
    }

    /**
     * {@inheritDoc}
     */
    public function setup()
    {
        $this->each(__FUNCTION__);
    }

    /**
     * {@inheritDoc}
     */
    public function tearDown()
    {
        $this->each(__FUNCTION__);
    }

    /**
     * {@inheritDoc}
     */
    public function shutdown()
    {
        $this->each(__FUNCTION__);
    }

    //endregion


    //region Helpers

    /**
     * Runs the given lifecycle method on each of the extensions.
     */
    protected function each(string $method, ...$args)
    {
        foreach ($this->loaded as $extension) {
            call_user_func_array([$extension, $method], $args);
        }
    }

    /**
     * Validates that the user has configured the extensions correctly.
     */
    protected function validate()
    {
        foreach ($this->loaded as $extension) {
            if (!$extension instanceof Extension) {
                throw new BailOutError('Invalid extension configured');
            }
        }
    }

    //endregion
}
