<?php

namespace Reedware\ContainerTestCase\Concerns;

use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Reedware\ContainerTestCase\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): ApplicationContract
    {
        return new Application();
    }
}
