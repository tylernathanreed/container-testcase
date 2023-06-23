<?php

namespace Reedware\ContainerTestCase;

trait ServiceContainer
{
    use Concerns\CreatesApplication;
    use Concerns\InteractsWithContainer;
    use Concerns\MakesArrayAssertions;

    /**
     * Sets up the environment before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpServiceContainer();
    }

    /**
     * Sets up the service container and its dependencies.
     */
    protected function setUpServiceContainer(): void
    {
        $this->setUpContainer();
    }

    /**
     * Tears down the application after each test.
     */
    protected function tearDown(): void
    {
        $this->tearDownServiceContainer();

        parent::tearDown();
    }

    /**
     * Tears down the service container and its dependencies.
     */
    protected function tearDownServiceContainer(): void
    {
        $this->tearDownContainer();
        $this->tearDownMockery();
        $this->tearDownCarbon();
    }
}
