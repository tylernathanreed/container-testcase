<?php

use Carbon\Carbon;
use Illuminate\Contracts\Container\Container;

it('resolves the service container', function () {
    expect(app())->toBeInstanceOf(Container::class);
});

it('makes from the service container', function () {
    app()->instance('foo', 'bar');

    expect(app('foo'))->toBe('bar');
});

it('returns the current timestamp', function () {
    Carbon::setTestNow('2023-01-01 12:34:56');

    expect(now()->toDateTimeString())->toBe('2023-01-01 12:34:56');
});

it('resolves from the service container', function () {
    app()->instance('foo', 'bar');

    expect(resolve('foo'))->toBe('bar');
});

it('returns the today timestamp', function () {
    Carbon::setTestNow('2023-01-01 12:34:56');

    expect(today()->toDateTimeString())->toBe('2023-01-01 00:00:00');
});
