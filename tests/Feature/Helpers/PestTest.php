<?php

use Mockery\MockInterface;
use Reedware\ContainerTestCase\Tests\Fixtures\DummyService;

use function Pest\Laravel\instance;
use function Pest\Laravel\mock;
use function Pest\Laravel\mockAs;
use function Pest\Laravel\partialMock;
use function Pest\Laravel\spy;
use function Pest\Laravel\swap;

it('swaps instances in the container', function () {
    app()->instance('foo', 'bar');

    $result = swap('foo', 'baz');

    expect($result)->toBe('baz');

    expect(resolve('foo'))->toBe('baz');
});

it('sets instances in the container', function () {
    instance('foo', 'bar');

    expect(resolve('foo'))->toBe('bar');
});

it('mocks instances in the container', function () {
    $mock = mock(DummyService::class);

    expect(app()->bound(DummyService::class))->toBe(true);

    expect(resolve(DummyService::class))
        ->toBeInstanceof(DummyService::class)
        ->toBeInstanceof(MockInterface::class)
        ->toBe($mock);
});

it('mocks instances in the using an alias container', function () {
    $mock = mockAs(DummyService::class, 'dummy');

    expect(app()->bound('dummy'))->toBe(true);

    expect(resolve('dummy'))
        ->toBeInstanceof(DummyService::class)
        ->toBeInstanceof(MockInterface::class)
        ->toBe($mock);
});

it('partially mocks instances in the container', function () {
    $mock = partialMock(DummyService::class);

    expect(app()->bound(DummyService::class))->toBe(true);

    expect(resolve(DummyService::class))
        ->toBeInstanceof(DummyService::class)
        ->toBeInstanceof(MockInterface::class)
        ->toBe($mock);
});

it('spies mocks instances in the container', function () {
    $mock = spy(DummyService::class);

    expect(app()->bound(DummyService::class))->toBe(true);

    expect(resolve(DummyService::class))
        ->toBeInstanceof(DummyService::class)
        ->toBeInstanceof(MockInterface::class)
        ->toBe($mock);
});
