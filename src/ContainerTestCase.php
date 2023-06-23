<?php

namespace Reedware\ContainerTestCase;

use PHPUnit\Framework\TestCase;

/**
 * This type of test offers an IoC container, but does not boot the
 * Laravel framework. This results in limited functionality, but
 * offers a significant performance boost. Extend this wisely.
 */
abstract class ContainerTestCase extends TestCase
{
    use ServiceContainer;
}
