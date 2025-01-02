<?php

namespace Reedware\ContainerTestCase\Concerns;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Foundation\Application as LaravelApplication;
use Reedware\ContainerTestCase\Application as ReedwareApplication;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): ApplicationContract
    {
        if (class_exists(LaravelApplication::class)) {
            return new LaravelApplication('~');
        }

        return new ReedwareApplication;
    }
}
