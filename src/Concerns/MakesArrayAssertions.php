<?php

namespace Reedware\ContainerTestCase\Concerns;

use Illuminate\Testing\Constraints\ArraySubset;
use PHPUnit\Framework\Assert as PHPUnit;

trait MakesArrayAssertions
{
    /**
     * Asserts that an array has a specified subset.
     *
     * @param  iterable<mixed, mixed>  $subset
     * @param  iterable<mixed, mixed>  $array
     */
    public static function assertArraySubset(
        iterable $subset,
        iterable $array,
        bool $checkForIdentity = false,
        string $msg = ''
    ): void {
        $constraint = new ArraySubset($subset, $checkForIdentity);

        PHPUnit::assertThat($array, $constraint, $msg);
    }
}
