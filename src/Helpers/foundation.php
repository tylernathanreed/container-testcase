<?php

use Carbon\Carbon;
use Composer\InstalledVersions as Composer;
use Illuminate\Container\Container;

if (Composer::isInstalled('laravel/framework')) {
    return;
}

if (! function_exists('app')) {
    /**
     * Returns the available container instance.
     *
     * @param  array<string,mixed>  $parameters
     */
    function app(string $abstract = null, array $parameters = []): mixed
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}

if (! function_exists('now')) {
    /**
     * Creates and returns a new Carbon instance for the current time.
     */
    function now(DateTimeZone|string $tz = null): Carbon
    {
        return Carbon::now($tz);
    }
}

if (! function_exists('resolve')) {
    /**
     * Resolves the specified service from the container.
     *
     * @param  array<string,mixed>  $parameters
     */
    function resolve(string $name, array $parameters = []): mixed
    {
        return app($name, $parameters);
    }
}
