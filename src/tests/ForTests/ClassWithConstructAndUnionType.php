<?php

declare(strict_types=1);

namespace Tests\ForTests;

class ClassWithConstructAndUnionType
{
    public function __construct(
        public InterfaceForTests|array $unionType
    ) {

    }
}