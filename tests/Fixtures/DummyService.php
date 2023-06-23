<?php

namespace Reedware\ContainerTestCase\Tests\Fixtures;

class DummyService
{
    public function __construct(
        public DummyDependency $dependency
    ) {
        //
    }
}
