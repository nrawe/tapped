# Tapped
> It's testing, Jim, but not as we know it

This represents an attempt to write an elegant, simple testing framework for PHP. It is based on Test Anything Protocol, and leverages the advances in PHP7.


## Another Testing Framework, Really?

Yes, and I feel your pain but bear with me. I've worked with TDD, BDD in XUnit, Gherkin, XSpec and more. Over the course of 7 years of professional development I've tried to reconcile pragmatism with theory on the nature of testing. I've seen the work of people in similar boats who have tried to do wonderful, simple things, and incredible peices of work of a highly engineered nature. They have pushed boundaries, but none of them have fit my needs.

And so, after much deliberation, I've created this one. It's goal is to leverage the advantages of PHP7 and the general environment for development in PHP to create a simple, fast, and elegant testing system. The realisation of this goal will be a holistic system which I can apply with equal ease to command line, script, API and Web Application development. I share this in the hopes of progressing that goal, and that it can be useful to others.


## Installing

`$ composer require --dev nrawe/tapped`. Et, voila.


## Running Tests

The best way to run the tool is to add it as a [custom command to composer](https://getcomposer.org/doc/articles/scripts.md#writing-custom-commands)--

```
{
    "scripts": {
        "test": "tapped"
    }
}
```

You can then `$ composer test`. Easy, peasy.


## Defining Tests

Tapped always looks for a folder called `tests` in it's current working directory. It loads composer, and then performs an isolated require on the files ending `Test.php`. A test file, at it's simplest, looks as follows.

```php
<?php
// tests/MyTest.php

use function Rawebone\Tapped\test;

test('Tapped can perform a basic assertion', function ($expect) {
    $expect(1)->toEqual(1)->when('The framework is working');
});
```

When running `$ composer test` this will output--

```
TAP version 13

# Tapped can perform a basic assertion
ok 1 The framework is working

1..1
# tests 1
# pass  1
# fail  0
```

This output should match that given by [Tape](https://github.com/substack/tape).

## Helper Methods

The testing framework also has a couple of other methods for working with TAP.

```php
<?php

use function Rawebone\Tapped\{test, skip, todo};

test('This is a test', function ($expect) {
    $this->pass('Woohoo');
    $this->fail(':(');
    $this->skip('Something to be skipped');
    $this->todo('Something todo');
    $this->bailOut('OMG something went very wrong!');
});

skip('This will be skipped', function ($expect) {
    // This will not be executed, with a skip message given
});

todo('This will be skipped, too', function ($expect) {
    // This will not be executed, with a todo message given
});

```


## Extensions

To allow it to as maleable as possible to different situations, the framework
does not implement a lot beyond it's core functionality. Instead, it defers to
Extensions.

An extension is created by implementing the `Rawebone\Tapped\Extension` base
class. This class contains a number of well documented methods about when the
methods will be called.

Extensions are loaded by creating a file `tests/extensions.php` which looks
like--

```php
<?php

return [
    new MyExtension(),
];
```


## Roadmap

This project is a very early release. It's basically functional, but lacking in a lot
of areas.

Please see the [Project](https://github.com/nrawe/tapped/projects/1) for more information.


## License

This project is release under an [MIT License](LICENSE).
