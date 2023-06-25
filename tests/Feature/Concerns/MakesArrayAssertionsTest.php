<?php

use Composer\InstalledVersions as Composer;

beforeEach()->skip(function () {
    // There is currently a bug in Laravel 9.x, where if you are
    // using PHPUnit 10.x, the ArraySubset constraint breaks.
    // If you're on PHPUnit 9.x or Laravel 10.x, it works.

    $laravel = Composer::isInstalled('laravel/framework')
        ? Composer::getVersion('laravel/framework')
        : Composer::getVersion('illuminate/testing');

    $phpunit = Composer::getVersion('phpunit/phpunit');

    $isLaravel9 = explode('.', $laravel)[0] == 9;
    $isPhpUnit10 = explode('.', $phpunit)[0] == 10;

    return $isLaravel9 && $isPhpUnit10;
}, 'Feature unavailable on Laravel 9.x w/ PHPUnit 10.x');

it('can make array assertions with phpunit style', function () {
    $expected = [
        'expected' => 'foo',
    ];

    $actual = [
        'expected' => 'foo',
        'actual' => 'bar',
    ];

    test()->assertArraySubset($expected, $actual);
});

it('can make array assertions with pest style', function () {
    $expected = [
        'expected' => 'foo',
    ];

    $actual = [
        'expected' => 'foo',
        'actual' => 'bar',
    ];

    expect($actual)->toContainArraySubset($expected);
});
