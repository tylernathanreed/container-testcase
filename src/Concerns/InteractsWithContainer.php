<?php

namespace Reedware\ContainerTestCase\Concerns;

use Carbon\CarbonImmutable;
use Closure;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;
use Mockery;
use Mockery\MockInterface;

trait InteractsWithContainer
{
    /**
     * The application container implementation.
     */
    public ?ApplicationContract $app;

    /**
     * Sets up an empty IoC application container.
     */
    protected function setUpContainer(): void
    {
        $app = $this->createApplication();

        /** @var ApplicationContract&MockInterface $mock */
        $mock = Mockery::mock($app)->makePartial();

        $this->registerApplicationBindings($mock);

        $this->app = $mock;
    }

    /**
     * Registers the specified instance to all of the application bindings.
     */
    protected function registerApplicationBindings(ApplicationContract $app): void
    {
        Container::setInstance($app);
        $app->instance('app', $app);
        $app->instance(Container::class, $app);

        Facade::setFacadeApplication($app);
    }

    /**
     * Creates the specified service provider.
     */
    protected function newServiceProvider(string $class): ServiceProvider
    {
        if (! is_a($class, ServiceProvider::class, true)) {
            throw new InvalidArgumentException(sprintf(
                'Class [%s] must extend from [%s].',
                $class,
                ServiceProvider::class
            ));
        }

        return new $class($this->app);
    }

    /**
     * Registers the specified service provider.
     */
    public function registerServiceProvider(string $class): ServiceProvider
    {
        $provider = $this->newServiceProvider($class);

        $provider->register();

        return $provider;
    }

    /**
     * Boots the specified service provider.
     */
    public function bootServiceProvider(string $class): ServiceProvider
    {
        $provider = $this->newServiceProvider($class);

        if (method_exists($provider, 'boot')) {
            $this->app?->call([$provider, 'boot']);
        }

        return $provider;
    }

    /**
     * Creates a new instance of the specified service using the container.
     */
    public function make(string $class): mixed
    {
        return $this->app?->make($class);
    }

    /**
     * Creates a mock of the specified service and binds it to the container.
     */
    public function mock(string|object $service, Closure $callback = null): MockInterface
    {
        $alias = is_string($service)
            ? $service
            : get_class($service);

        return $this->mockAs($service, $alias, $callback);
    }

    /**
     * Creates a mock of the specified service and binds it to the container under the given alias.
     */
    public function mockAs(string|object $service, string $alias, Closure $callback = null): MockInterface
    {
        /** @var MockInterface */
        $mock = Mockery::mock($service);

        if (! is_null($callback)) {
            $callback($mock);
        }

        $this->app?->instance($alias, $mock);

        return $mock;
    }

    /**
     * Creates a mock of the configuration service and binds it to the container.
     *
     * @param  array<string, mixed>  $config
     */
    public function mockConfig(array $config): MockInterface
    {
        return $this->mockAs(Config::class, 'config', function (MockInterface $mock) use ($config) {
            $mock
                ->shouldReceive('get')
                ->andReturnUsing(function (string $key, mixed $default = null) use (&$config) {
                    return Arr::get($config, $key, $default);
                });

            $mock
                ->shouldReceive('set')
                ->andReturnUsing(function (string $key, mixed $value) use (&$config) {
                    return Arr::set($config, $key, $value);
                });
        });
    }

    /**
     * Tears down the IoC application container.
     */
    protected function tearDownContainer(): void
    {
        $this->app?->flush();
        $this->app = null;

        Facade::clearResolvedInstances();
        Facade::setFacadeApplication(null); // @phpstan-ignore-line
    }

    /**
     * Tears down Mockery.
     */
    protected function tearDownMockery(): void
    {
        $container = Mockery::getContainer();

        $this->addToAssertionCount($container->mockery_getExpectationCount());

        Mockery::close();
    }

    /**
     * Tears down Carbon.
     */
    protected function tearDownCarbon(): void
    {
        Carbon::setTestNow();
        CarbonImmutable::setTestNow();
    }
}
