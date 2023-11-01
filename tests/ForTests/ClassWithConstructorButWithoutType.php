<?php

declare(strict_types=1);

namespace Tests\ForTests;

class ClassWithConstructButWithoutType
{
    public function __construct(
        public $noType
    ) {

    }
}