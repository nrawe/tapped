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
     * Registers a new extension for use.
     */
    public function register(Extension $extension)
    {
        $this->loaded[] = $extension;
    }

    /**
     * Registers many extensions for use.
     */
    public function registerMany(array $extensions)
    {
        foreach ($extensions as $extension) {
            if (!$extension instanceof Extension) {
                throw new BailOutError('Invalid extension provided.');
            }

            $this->register($extension);
        }
    }


    //region Extension Events

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
    public function comparisons(Comparator $comparator)
    {
        $this->each(__FUNCTION__, $comparator);
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

    //endregion
}
