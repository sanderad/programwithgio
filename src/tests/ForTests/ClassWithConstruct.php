<?php

declare(strict_types=1);

namespace Tests\ForTests;

class ClassWithConstruct
{
    public function __construct(
        public InterfaceForTests $interfaceForTests
    ) {

    }
}