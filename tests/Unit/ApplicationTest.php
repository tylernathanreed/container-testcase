<?php

use Reedware\ContainerTestCase\Application;
use Reedware\ContainerTestCase\MethodNotMockedException;

it('throws on all application methods', function (string $method, ...$params) {
    $app = Application::getInstance();

    expect(fn () => $app->{$method}(...$params))->toThrow(function (MethodNotMockedException $e) use ($method) {
        expect($e->getMessage())->toBe("Method [{$method}] must be mocked.");
    });
})->with([
    ['version'],
    ['basePath'],
    ['bootstrapPath'],
    ['configPath'],
    ['databasePath'],
    ['langPath'],
    ['publicPath'],
    ['resourcePath'],
    ['storagePath'],
    ['environment'],
    ['runningInConsole'],
    ['runningUnitTests'],
    ['hasDebugModeEnabled'],
    ['maintenanceMode'],
    ['isDownForMaintenance'],
    ['registerConfiguredProviders'],
    ['register', 'foo'],
    ['registerDeferredProvider', 'foo'],
    ['resolveProvider', 'foo'],
    ['boot'],
    ['booting', fn () => null],
    ['booted', fn () => null],
    ['bootstrapWith', []],
    ['getLocale'],
    ['getNamespace'],
    ['getProviders', 'foo'],
    ['hasBeenBootstrapped'],
    ['loadDeferredProviders'],
    ['setLocale', 'foo'],
    ['shouldSkipMiddleware'],
    ['terminating', fn () => null],
    ['terminate'],
]);
