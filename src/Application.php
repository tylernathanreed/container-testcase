<?php

namespace Reedware\ContainerTestCase;

use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application as ApplicationContract;

class Application extends Container implements ApplicationContract
{
    /**
     * Create a new application instance.
     */
    public function __construct()
    {
        $this->registerBaseBindings();
    }

    /**
     * Register the basic bindings into the container.
     */
    protected function registerBaseBindings(): void
    {
        static::setInstance($this);

        $this->instance('app', $this);

        $this->instance(Container::class, $this);
    }

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version()
    {
        $this->throw();
    }

    /**
     * Get the base path of the Laravel installation.
     *
     * @param  string  $path
     * @return string
     */
    public function basePath($path = '')
    {
        $this->throw();
    }

    /**
     * Get the path to the bootstrap directory.
     *
     * @param  string  $path
     * @return string
     */
    public function bootstrapPath($path = '')
    {
        $this->throw();
    }

    /**
     * Get the path to the application configuration files.
     *
     * @param  string  $path
     * @return string
     */
    public function configPath($path = '')
    {
        $this->throw();
    }

    /**
     * Get the path to the database directory.
     *
     * @param  string  $path
     * @return string
     */
    public function databasePath($path = '')
    {
        $this->throw();
    }

    /**
     * Get the path to the language files.
     *
     * @param  string  $path
     * @return string
     */
    public function langPath($path = '')
    {
        $this->throw();
    }

    /**
     * Get the path to the public directory.
     *
     * @param  string  $path
     * @return string
     */
    public function publicPath($path = '')
    {
        $this->throw();
    }

    /**
     * Get the path to the resources directory.
     *
     * @param  string  $path
     * @return string
     */
    public function resourcePath($path = '')
    {
        $this->throw();
    }

    /**
     * Get the path to the storage directory.
     *
     * @param  string  $path
     * @return string
     */
    public function storagePath($path = '')
    {
        $this->throw();
    }

    /**
     * Get or check the current application environment.
     *
     * @param  string|array<string>  ...$environments
     * @return string|bool
     */
    public function environment(...$environments)
    {
        $this->throw();
    }

    /**
     * Determine if the application is running in the console.
     *
     * @return bool
     */
    public function runningInConsole()
    {
        $this->throw();
    }

    /**
     * Determine if the application is running unit tests.
     *
     * @return bool
     */
    public function runningUnitTests()
    {
        $this->throw();
    }

    /**
     * Determine if the application is running with debug mode enabled.
     *
     * @return bool
     */
    public function hasDebugModeEnabled()
    {
        $this->throw();
    }

    /**
     * Get an instance of the maintenance mode manager implementation.
     *
     * @return \Illuminate\Contracts\Foundation\MaintenanceMode
     */
    public function maintenanceMode()
    {
        $this->throw();
    }

    /**
     * Determine if the application is currently down for maintenance.
     *
     * @return bool
     */
    public function isDownForMaintenance()
    {
        $this->throw();
    }

    /**
     * Register all of the configured providers.
     *
     * @return void
     */
    public function registerConfiguredProviders()
    {
        $this->throw();
    }

    /**
     * Register a service provider with the application.
     *
     * @param  \Illuminate\Support\ServiceProvider|string  $provider
     * @param  bool  $force
     * @return \Illuminate\Support\ServiceProvider
     */
    public function register($provider, $force = false)
    {
        $this->throw();
    }

    /**
     * Register a deferred provider and service.
     *
     * @param  string  $provider
     * @param  string|null  $service
     * @return void
     */
    public function registerDeferredProvider($provider, $service = null)
    {
        $this->throw();
    }

    /**
     * Resolve a service provider instance from the class name.
     *
     * @param  string  $provider
     * @return \Illuminate\Support\ServiceProvider
     */
    public function resolveProvider($provider)
    {
        $this->throw();
    }

    /**
     * Boot the application's service providers.
     *
     * @return void
     */
    public function boot()
    {
        $this->throw();
    }

    /**
     * Register a new boot listener.
     *
     * @param  callable  $callback
     * @return void
     */
    public function booting($callback)
    {
        $this->throw();
    }

    /**
     * Register a new "booted" listener.
     *
     * @param  callable  $callback
     * @return void
     */
    public function booted($callback)
    {
        $this->throw();
    }

    /**
     * Run the given array of bootstrap classes.
     *
     * @param  array<string>  $bootstrappers
     * @return void
     */
    public function bootstrapWith(array $bootstrappers)
    {
        $this->throw();
    }

    /**
     * Get the current application locale.
     *
     * @return string
     */
    public function getLocale()
    {
        $this->throw();
    }

    /**
     * Get the application namespace.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function getNamespace()
    {
        $this->throw();
    }

    /**
     * Get the registered service provider instances if any exist.
     *
     * @param  \Illuminate\Support\ServiceProvider|string  $provider
     * @return array<\Illuminate\Support\ServiceProvider>
     */
    public function getProviders($provider)
    {
        $this->throw();
    }

    /**
     * Determine if the application has been bootstrapped before.
     *
     * @return bool
     */
    public function hasBeenBootstrapped()
    {
        $this->throw();
    }

    /**
     * Load and boot all of the remaining deferred providers.
     *
     * @return void
     */
    public function loadDeferredProviders()
    {
        $this->throw();
    }

    /**
     * Set the current application locale.
     *
     * @param  string  $locale
     * @return void
     */
    public function setLocale($locale)
    {
        $this->throw();
    }

    /**
     * Determine if middleware has been disabled for the application.
     *
     * @return bool
     */
    public function shouldSkipMiddleware()
    {
        $this->throw();
    }

    /**
     * Register a terminating callback with the application.
     *
     * @param  callable|string  $callback
     * @return \Illuminate\Contracts\Foundation\Application
     */
    public function terminating($callback)
    {
        $this->throw();
    }

    /**
     * Terminate the application.
     *
     * @return void
     */
    public function terminate()
    {
        $this->throw();
    }

    /**
     * Throws a "method not mocked" exception for the calling method.
     *
     * @throws MethodNotMockedException
     */
    protected function throw(): never
    {
        $method = debug_backtrace(0, 2)[1]['function'];

        throw new MethodNotMockedException("Method [{$method}] must be mocked.");
    }
}
