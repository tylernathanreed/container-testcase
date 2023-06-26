<?php

use Illuminate\Foundation\Application as LaravelApplication;
use Mockery\MockInterface;
use Reedware\ContainerTestCase\Application as ReedwareApplication;

it('creates a mock application', function () {
    expect(test()->app)->toBeInstanceOf(MockInterface::class);
});

it('creates an application that throws', function () {
    expect(test()->app)->toBeInstanceOf(ReedwareApplication::class);
});

it('when the laravel application exists, it is used instead', function () {
    require_once implode(DIRECTORY_SEPARATOR, [
        __DIR__,   // ~/tests/Feature/Concerns
        '..',      // ~/tests/Feature
        '..',      // ~/tests
        'app.php', // ~/tests/app.php
    ]);

    $app = test()->createApplication();

    expect($app)->toBeInstanceOf(LaravelApplication::class);
});
