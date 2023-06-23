<?php

namespace Reedware\ContainerTestCase\Tests\Fixtures;

use Illuminate\Support\ServiceProvider;

class DummyServiceProvider extends ServiceProvider
{
    public bool $registered = false;

    public bool $booted = false;

    /**
     * @return void
     */
    public function register()
    {
        $this->registered = true;
    }

    /**
     * @return void
     */
    public function boot(DummyService $service)
    {
        $this->booted = true;
    }
}
