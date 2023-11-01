<?php

declare(strict_types=1);

namespace Tests\DataProviders;

use Tests\ForTests\ClassWithConstructAndUnionType;
use Tests\ForTests\ClassWithConstructButWithoutType;
use Tests\ForTests\InterfaceForTests;

class ContainerDataProvider
{
    public function errorsForResolveMethod(): array
    {
        return [
            [InterfaceForTests::class],
            [ClassWithConstructAndUnionType::class],
            [ClassWithConstructButWithoutType::class],
        ];
    }
}