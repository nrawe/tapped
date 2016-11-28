<?php

namespace Rawebone\Tapped;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use RecursiveRegexIterator;

/**
 * Provides information about the system we are working on.
 */
class Environment
{
    /**
     * The path which we should look for test files in.
     *
     * @var string
     */
    protected $path;

    /**
     * Creates a new instance of the Environment.
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Returns an array of extensions, if available.
     */
    public function extensions(): array
    {
        if (is_file($this->extensionFile())) {
            return require $this->extensionFile();
        }

        return [];
    }

    /**
     * Returns the file which should contain the extensions.
     */
    public function extensionFile(): string
    {
        return $this->path . DIRECTORY_SEPARATOR . 'extensions.php';
    }

    /**
     * Loads the mocks for the test harness.
     */
    public function loadFixtures()
    {
        if (is_file($this->fixturesFile())) {
            require_once $this->fixturesFile();
        }
    }

    /**
     * Returns the file which should contain the fixtures.
     */
    public function fixturesFile(): string
    {
        return $this->path . DIRECTORY_SEPARATOR . 'fixtures.php';
    }

    /**
     * Returns the files which are deemed to contain tests.
     */
    public function testFiles(): array
    {
        // Ignore missing test directories
        if (!is_dir($this->path)) {
            return [];
        }
        
        $directory = new RecursiveDirectoryIterator($this->path);
        $iterator = new RecursiveIteratorIterator($directory);
        $regex = new RegexIterator(
            $iterator, '/^.+Test\.php$/i', RecursiveRegexIterator::GET_MATCH
        );

        $items = iterator_to_array($regex);

        return array_map(function ($item) {
            return $item[0]; // Send back the file name
        }, $items);
    }
}
