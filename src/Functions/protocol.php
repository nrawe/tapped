<?php

namespace Rawebone\Tapped\Protocol;

/**
 * This file contains the handling for writing out TAP lines.
 *
 * As this isn't based on state, it has been written as a functional interface
 * rather than an object.
 */

function write(...$messages)
{
    echo join(' ', $messages), PHP_EOL;
}

function ok(int $number, string $message)
{
    write('ok', $number, $message);
}

function notOk(int $number, string $message)
{
    write('not ok', $number, $message);
}

function bailOut(string $message)
{
    write('bail out!', $message);
}

function skip(int $number, string $message)
{
    notOk($number, '# SKIP ' . $message);
}

function todo(int $number, string $message)
{
    notOk($number, '# TODO ' . $message);
}

function plan(int $tests)
{
    write('1..' . $tests);
}

function version(int $version)
{
    write('TAP version', $version);
}

function directive(string $description)
{
    write('#', $description);
}

function blank()
{
    write();
}

function yaml(array $params)
{
    $spacer = str_repeat(' ', 4);

    write($spacer, '---');
    foreach ($params as $key => $value) {
        write($spacer, trim($key) . ':', var_export($value, true));
    }
    write($spacer, '...');
}
