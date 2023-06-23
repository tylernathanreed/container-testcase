<?php

use Composer\InstalledVersions as Composer;
use Illuminate\Testing\Constraints\ArraySubset;
use Pest\Expectation;
use PHPUnit\Framework\Assert as PHPUnit;

if (! Composer::isInstalled('pestphp/pest')) {
    return;
}

expect()->extend(
    'toContainArraySubset',
    function (iterable $subset, bool $checkForIdentity = false, string $msg = '') {
        /** @var Expectation */
        $self = $this; // @phpstan-ignore-line

        expect(is_iterable($self->value))->toBe(true, 'Expected value to be an iterable.');

        $constraint = new ArraySubset($subset, $checkForIdentity);

        PHPUnit::assertThat($self->value, $constraint, $msg);

        return $self;
    }
);
