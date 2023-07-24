<?php

namespace Pest\Laravel;

use Closure;
use Composer\InstalledVersions as Composer;
use Mockery\MockInterface;

if (! Composer::isInstalled('pestphp/pest')) {
    return;
}

if (Composer::isInstalled('pestphp/pest-plugin-laravel')) {
    return;
}

/**
 * Alias of {@see instance()}.
 */
function swap(string $abstract, string|object $instance): string|object
{
    return test()->swap(...func_get_args());
}

/**
 * Registers the specified instance of an object to the container.
 */
function instance(string $abstract, string|object $instance): string|object
{
    return test()->instance(...func_get_args());
}

/**
 * Mock an instance of an object in the container.
 */
function mock(string $abstract, Closure $mock = null): MockInterface
{
    return test()->mock(...func_get_args());
}

/**
 * Mock an instance of an object in the container using an alias.
 */
function mockAs(string $abstract, string $alias, Closure $mock = null): MockInterface
{
    return test()->mockAs(...func_get_args());
}

/**
 * Mock a partial instance of an object in the container.
 */
function partialMock(string $abstract, Closure $mock = null): MockInterface
{
    return test()->partialMock(...func_get_args());
}

/**
 * Spy an instance of an object in the container.
 */
function spy(string $abstract, Closure $mock = null): MockInterface
{
    return test()->spy(...func_get_args());
}
