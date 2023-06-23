<?php

use Mockery\MockInterface;
use Reedware\ContainerTestCase\Tests\Fixtures\DummyDependency;
use Reedware\ContainerTestCase\Tests\Fixtures\DummyService;
use Reedware\ContainerTestCase\Tests\Fixtures\DummyServiceProvider;

it('registers service providers', function () {
    /** @var DummyServiceProvider */
    $provider = test()->registerServiceProvider(DummyServiceProvider::class);

    expect($provider->registered)->toBe(true);
    expect($provider->booted)->toBe(false);
});

it('boots service providers', function () {
    /** @var DummyServiceProvider */
    $provider = test()->bootServiceProvider(DummyServiceProvider::class);

    expect($provider->registered)->toBe(false);
    expect($provider->booted)->toBe(true);
});

it('makes services', function () {
    $dependency = new DummyDependency;

    test()->app->instance(DummyDependency::class, $dependency);

    $service = test()->make(DummyService::class);

    expect($service->dependency)->toBe($dependency);
});

it('mocks service classes', function () {
    $service = test()->mock(DummyService::class);

    expect(test()->app->bound(DummyService::class))->toBe(true);
    expect($service)->toBeInstanceOf(MockInterface::class);
    expect($service)->toBeInstanceOf(DummyService::class);
});

it('mocks service instances', function () {
    $service = new DummyService(new DummyDependency);
    $mock = test()->mock($service);

    expect(test()->app->bound(DummyService::class))->toBe(true);
    expect($mock)->toBeInstanceOf(MockInterface::class);
    expect($mock)->toBeInstanceOf(DummyService::class);
});

it('mocks with callback support', function () {
    $service = test()->mock(DummyService::class, function (MockInterface $mock) {
        $mock
            ->shouldReceive('foo')
            ->withNoArgs()
            ->once()
            ->andReturn('bar');
    });

    expect($service->foo())->toBe('bar');
});

it('mocks with an alias', function () {
    $service = test()->mockAs(DummyService::class, 'service');

    expect(test()->app->bound(DummyService::class))->toBe(false);
    expect(test()->app->bound('service'))->toBe(true);

    expect($service)->toBeInstanceOf(MockInterface::class);
    expect($service)->toBeInstanceOf(DummyService::class);
});

it('mocks config', function () {
    $config = test()->mockConfig(['foo' => 'bar']);

    expect($config->get('foo'))->toBe('bar');

    $config->set('foo', 'baz');

    expect($config->get('foo'))->toBe('baz');
});
