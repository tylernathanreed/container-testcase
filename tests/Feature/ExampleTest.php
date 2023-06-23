<?php

use Reedware\ContainerTestCase\ContainerTestCase;

it('is a container test case', function () {
    // This also serves as a smoke test for the setUp and tearDown methods
    expect(test()->target)->toBeInstanceOf(ContainerTestCase::class);
});
