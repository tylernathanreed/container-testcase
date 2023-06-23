# Container TestCase

This package enables unit testing with an empty service container.

## Introduction

I'm a huge advocate for unit testing, but when developing packages for Laravel, I often find myself needing the service container within my unit tests. This package simply implements a pattern I've been following for years, but never defined in a shared location.

This approach to testing keeps your test cases light, as you don't have to boot the entire Laravel application, but you still get some quality of life features necessary for testing services created as a part of package development.

## Installation

Install this package using Composer:

```
composer require reedware/container-testcase --dev
```

Take note of the `--dev` flag. This package is intended for testing. As such, it should only be required in dev settings.

Next, you have two options: Extension or Trait.

### Extension

Change your test case to extend from `Reedware\ContainerTestCase\ContainerTestCase`.

```php
use Reedware\ContainerTestCase\ContainerTestCase;

class TestCase extends ContainerTestCase
{
    /* ... */
}
```

### Trait

Add the `ServiceContainer` trait to your test case.

```php
use PHPUnit\Framework\TestCase as BaseTestCase;
use Reedware\ContainerTestCase\ServiceContainer;

class TestCase extends BaseTestCase
{
    use ServiceContainer;
}
```

Be mindful that the trait overrides the `setUp()` and `tearDown()` methods. If you have your own definition, you'll need to call the setUp/tearDown functionality provided by the trait.

```php
protected function setUp(): void
{
    parent::setUp();

    $this->setUpServiceContainer();
}

protected function tearDown(): void
{
    $this->tearDownServiceContainer();

    parent::tearDown();
}
```

## Usage

### Service Provider

If you're writing a package that binds into the service container, chances are, you have a service provider. You'll want to register your service provider during the setup process:

```php
protected function setUp(): void
{
    parent::setUp();

    $this->registerServiceProvider(MyServiceProvider::class);
}
```

You can do something similar for booting:

```php
protected function setUp(): void
{
    parent::setUp();

    $this->bootServiceProvider(MyServiceProvider::class);
}
```

Any dependencies in your `boot()` method will be injected from the service container, exactly how the Laravel Framework does it.

### The Application Instance

The application instance in your test is not the same as the one provided by the Laravel Framework. The provided application instance offers full container functionality, but throws by default on any non-container method (e.g. `$this->app->version()`). If you need to use these methods in your service providers, you can provide expectations to the application instance, as it also acts as a partial mock instance.

```php
/** @test */
public function it_bails_on_production(): void
{
    $this->app
        ->shouldReceive('environment')
        ->withNoArgs()
        ->once()
        ->andReturn('production');

    $this->registerServiceProvider(MyServiceProvider::class);

    $this->assertFalse($this->app->bound(MyService::class));
}
```

### The Service Container

The application instance acts as your service container. Similar to Laravel's feature test, some mocking and container helpers are available as methods on your test cases:

#### Make

Creates a new instance of the specified service using the container. Alias for `$this->app->make(...)`.

Usage:
```php
$service = $this->make(MyService::class);
```

#### Mock

Creates a mock of the specified service and binds it to the container.

Usage:
```php
$mock = $this->mock(MyService::class, function (MockInterface $mock) {
    $mock
        ->shouldReceive(...)
        ->...
});
```
or
```php
$mock = $this->mock(MyService::class);

$mock
    ->shouldReceive(...)
    ->...
```

Note: This method binds the mock instance to `MyService::class`. If you just want a mocked service without binding it to the container, use `Mockery::mock(MyService::class)`.

#### Mock As

Creates a mock of the specified service and binds it to the container under the given alias. The `$this->mock(...)` method will bind the service to the container using its class name. However, if you wish to bind it under a different name, you can use `$this->mockAs(...)`.

Usage:
```php
$mock = $this->mockAs(MyService::class, 'acme.service', function (MockInterface $mock) {
    /* ... */
});
```

Anything that resolves `acme.service` from the container will now receive your mocked service.

#### Mock Config

For packages that ship with a configuration file, and still want to unit test their services, you can use `$this->mockConfig(...)` to bind a basic configuration repository to the container that yields the provided values.

Usage:
```php
$this->mockConfig([
    'my-package' => [
        'setting-1' => 'foo'
    ]
]);

config('my-package.setting-1'); // "foo"
```

## Assertions

Laravel's Test Case comes with some basic assertions that are useful in unit tests. These have also been included.

### Array Subset

Asserts that an array has a specified subset.

Usage:
```php
/** @test */
public function it_has_some_attributes(): void
{
    $myObject = $this->newMyObject();

    $this->assertArraySubset([
        'foo' => 'bar'
    ], $myObject->toArray());
}
```

### Pest

If you're using [Pest](https://pestphp.com/), expectation style assertions are also available.

- **PHPUnit => Pest**
- `$this->assertArraySubset($subset, $actual)` => `expect($actual)->toContainArraySubset($subset)`