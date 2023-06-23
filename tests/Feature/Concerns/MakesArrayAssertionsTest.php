<?php

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
